<?php
namespace Symfony\Component\Security\Core\Authentication;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class AuthenticationProviderManager implements AuthenticationManagerInterface
{
    private $providers;
    private $eraseCredentials;
    private $eventDispatcher;
    public function __construct(array $providers, $eraseCredentials = true)
    {
        if (!$providers) {
            throw new \InvalidArgumentException('You must at least add one authentication provider.');
        }
        $this->providers = $providers;
        $this->eraseCredentials = (bool) $eraseCredentials;
    }
    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->eventDispatcher = $dispatcher;
    }
    public function authenticate(TokenInterface $token)
    {
        $lastException = null;
        $result = null;
        foreach ($this->providers as $provider) {
            if (!$provider->supports($token)) {
                continue;
            }
            try {
                $result = $provider->authenticate($token);
                if (null !== $result) {
                    break;
                }
            } catch (AccountStatusException $e) {
                $e->setToken($token);
                throw $e;
            } catch (AuthenticationException $e) {
                $lastException = $e;
            }
        }
        if (null !== $result) {
            if (true === $this->eraseCredentials) {
                $result->eraseCredentials();
            }
            if (null !== $this->eventDispatcher) {
                $this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_SUCCESS, new AuthenticationEvent($result));
            }
            return $result;
        }
        if (null === $lastException) {
            $lastException = new ProviderNotFoundException(sprintf('No Authentication Provider found for token of class "%s".', get_class($token)));
        }
        if (null !== $this->eventDispatcher) {
            $this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_FAILURE, new AuthenticationFailureEvent($token, $lastException));
        }
        $lastException->setToken($token);
        throw $lastException;
    }
}