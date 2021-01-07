<?php
namespace Symfony\Component\Routing;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\ConfigCache;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Generator\ConfigurableRequirementsInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Generator\Dumper\GeneratorDumperInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Matcher\Dumper\MatcherDumperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
class Router implements RouterInterface, RequestMatcherInterface
{
    protected $matcher;
    protected $generator;
    protected $context;
    protected $loader;
    protected $collection;
    protected $resource;
    protected $options = array();
    protected $logger;
    private $expressionLanguageProviders = array();
    public function __construct(LoaderInterface $loader, $resource, array $options = array(), RequestContext $context = null, LoggerInterface $logger = null)
    {
        $this->loader = $loader;
        $this->resource = $resource;
        $this->logger = $logger;
        $this->context = $context ?: new RequestContext();
        $this->setOptions($options);
    }
    public function setOptions(array $options)
    {
        $this->options = array(
            'cache_dir' => null,
            'debug' => false,
            'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'generator_cache_class' => 'ProjectUrlGenerator',
            'matcher_class' => 'Symfony\\Component\\Routing\\Matcher\\UrlMatcher',
            'matcher_base_class' => 'Symfony\\Component\\Routing\\Matcher\\UrlMatcher',
            'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'matcher_cache_class' => 'ProjectUrlMatcher',
            'resource_type' => null,
            'strict_requirements' => true,
        );
        $invalid = array();
        foreach ($options as $key => $value) {
            if (array_key_exists($key, $this->options)) {
                $this->options[$key] = $value;
            } else {
                $invalid[] = $key;
            }
        }
        if ($invalid) {
            throw new \InvalidArgumentException(sprintf('The Router does not support the following options: "%s".', implode('", "', $invalid)));
        }
    }
    public function setOption($key, $value)
    {
        if (!array_key_exists($key, $this->options)) {
            throw new \InvalidArgumentException(sprintf('The Router does not support the "%s" option.', $key));
        }
        $this->options[$key] = $value;
    }
    public function getOption($key)
    {
        if (!array_key_exists($key, $this->options)) {
            throw new \InvalidArgumentException(sprintf('The Router does not support the "%s" option.', $key));
        }
        return $this->options[$key];
    }
    public function getRouteCollection()
    {
        if (null === $this->collection) {
            $this->collection = $this->loader->load($this->resource, $this->options['resource_type']);
        }
        return $this->collection;
    }
    public function setContext(RequestContext $context)
    {
        $this->context = $context;
        if (null !== $this->matcher) {
            $this->getMatcher()->setContext($context);
        }
        if (null !== $this->generator) {
            $this->getGenerator()->setContext($context);
        }
    }
    public function getContext()
    {
        return $this->context;
    }
    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        return $this->getGenerator()->generate($name, $parameters, $referenceType);
    }
    public function match($pathinfo)
    {
        return $this->getMatcher()->match($pathinfo);
    }
    public function matchRequest(Request $request)
    {
        $matcher = $this->getMatcher();
        if (!$matcher instanceof RequestMatcherInterface) {
            return $matcher->match($request->getPathInfo());
        }
        return $matcher->matchRequest($request);
    }
    public function getMatcher()
    {
        if (null !== $this->matcher) {
            return $this->matcher;
        }
        if (null === $this->options['cache_dir'] || null === $this->options['matcher_cache_class']) {
            $this->matcher = new $this->options['matcher_class']($this->getRouteCollection(), $this->context);
            if (method_exists($this->matcher, 'addExpressionLanguageProvider')) {
                foreach ($this->expressionLanguageProviders as $provider) {
                    $this->matcher->addExpressionLanguageProvider($provider);
                }
            }
            return $this->matcher;
        }
        $class = $this->options['matcher_cache_class'];
        $cache = new ConfigCache($this->options['cache_dir'].'/'.$class.'.php', $this->options['debug']);
        if (!$cache->isFresh()) {
            $dumper = $this->getMatcherDumperInstance();
            if (method_exists($dumper, 'addExpressionLanguageProvider')) {
                foreach ($this->expressionLanguageProviders as $provider) {
                    $dumper->addExpressionLanguageProvider($provider);
                }
            }
            $options = array(
                'class' => $class,
                'base_class' => $this->options['matcher_base_class'],
            );
            $cache->write($dumper->dump($options), $this->getRouteCollection()->getResources());
        }
        require_once $cache;
        return $this->matcher = new $class($this->context);
    }
    public function getGenerator()
    {
        if (null !== $this->generator) {
            return $this->generator;
        }
        if (null === $this->options['cache_dir'] || null === $this->options['generator_cache_class']) {
            $this->generator = new $this->options['generator_class']($this->getRouteCollection(), $this->context, $this->logger);
        } else {
            $class = $this->options['generator_cache_class'];
            $cache = new ConfigCache($this->options['cache_dir'].'/'.$class.'.php', $this->options['debug']);
            if (!$cache->isFresh()) {
                $dumper = $this->getGeneratorDumperInstance();
                $options = array(
                    'class' => $class,
                    'base_class' => $this->options['generator_base_class'],
                );
                $cache->write($dumper->dump($options), $this->getRouteCollection()->getResources());
            }
            require_once $cache;
            $this->generator = new $class($this->context, $this->logger);
        }
        if ($this->generator instanceof ConfigurableRequirementsInterface) {
            $this->generator->setStrictRequirements($this->options['strict_requirements']);
        }
        return $this->generator;
    }
    public function addExpressionLanguageProvider(ExpressionFunctionProviderInterface $provider)
    {
        $this->expressionLanguageProviders[] = $provider;
    }
    protected function getGeneratorDumperInstance()
    {
        return new $this->options['generator_dumper_class']($this->getRouteCollection());
    }
    protected function getMatcherDumperInstance()
    {
        return new $this->options['matcher_dumper_class']($this->getRouteCollection());
    }
}
