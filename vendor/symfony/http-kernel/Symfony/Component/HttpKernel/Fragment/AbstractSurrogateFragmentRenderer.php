<?php
namespace Symfony\Component\HttpKernel\Fragment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\HttpCache\SurrogateInterface;
use Symfony\Component\HttpKernel\UriSigner;
abstract class AbstractSurrogateFragmentRenderer extends RoutableFragmentRenderer
{
    private $surrogate;
    private $inlineStrategy;
    private $signer;
    public function __construct(SurrogateInterface $surrogate = null, FragmentRendererInterface $inlineStrategy, UriSigner $signer = null)
    {
        $this->surrogate = $surrogate;
        $this->inlineStrategy = $inlineStrategy;
        $this->signer = $signer;
    }
    public function render($uri, Request $request, array $options = array())
    {
        if (!$this->surrogate || !$this->surrogate->hasSurrogateCapability($request)) {
            return $this->inlineStrategy->render($uri, $request, $options);
        }
        if ($uri instanceof ControllerReference) {
            $uri = $this->generateSignedFragmentUri($uri, $request);
        }
        $alt = isset($options['alt']) ? $options['alt'] : null;
        if ($alt instanceof ControllerReference) {
            $alt = $this->generateSignedFragmentUri($alt, $request);
        }
        $tag = $this->surrogate->renderIncludeTag($uri, $alt, isset($options['ignore_errors']) ? $options['ignore_errors'] : false, isset($options['comment']) ? $options['comment'] : '');
        return new Response($tag);
    }
    private function generateSignedFragmentUri($uri, Request $request)
    {
        if (null === $this->signer) {
            throw new \LogicException('You must use a URI when using the ESI rendering strategy or set a URL signer.');
        }
        $fragmentUri = $this->signer->sign($this->generateFragmentUri($uri, $request, true));
        return substr($fragmentUri, strlen($request->getSchemeAndHttpHost()));
    }
}
