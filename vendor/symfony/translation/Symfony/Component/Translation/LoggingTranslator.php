<?php
namespace Symfony\Component\Translation;
use Psr\Log\LoggerInterface;
class LoggingTranslator implements TranslatorInterface, TranslatorBagInterface
{
    private $translator;
    private $logger;
    public function __construct($translator, LoggerInterface $logger)
    {
        if (!($translator instanceof TranslatorInterface && $translator instanceof TranslatorBagInterface)) {
            throw new \InvalidArgumentException(sprintf('The Translator "%s" must implements TranslatorInterface and TranslatorBagInterface.', get_class($translator)));
        }
        $this->translator = $translator;
        $this->logger = $logger;
    }
    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        $trans = $this->translator->trans($id, $parameters, $domain, $locale);
        $this->log($id, $domain, $locale);
        return $trans;
    }
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        $trans = $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
        $this->log($id, $domain, $locale);
        return $trans;
    }
    public function setLocale($locale)
    {
        $this->translator->setLocale($locale);
    }
    public function getLocale()
    {
        return $this->translator->getLocale();
    }
    public function getCatalogue($locale = null)
    {
        return $this->translator->getCatalogue($locale);
    }
    public function __call($method, $args)
    {
        return call_user_func_array(array($this->translator, $method), $args);
    }
    private function log($id, $domain, $locale)
    {
        if (null === $locale) {
            $locale = $this->getLocale();
        }
        if (null === $domain) {
            $domain = 'messages';
        }
        $id = (string) $id;
        $catalogue = $this->translator->getCatalogue($locale);
        if ($catalogue->defines($id, $domain)) {
            return;
        }
        if ($catalogue->has($id, $domain)) {
            $this->logger->debug('Translation use fallback catalogue.', array('id' => $id, 'domain' => $domain, 'locale' => $catalogue->getLocale()));
        } else {
            $this->logger->warning('Translation not found.', array('id' => $id, 'domain' => $domain, 'locale' => $catalogue->getLocale()));
        }
    }
}