<?php
namespace Symfony\Component\HttpKernel\Fragment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
class InlineFragmentRenderer extends RoutableFragmentRenderer
{
    private $kernel;
    private $dispatcher;
    public function __construct(HttpKernelInterface $kernel, EventDispatcherInterface $dispatcher = null)
    {
        $this->kernel = $kernel;
        $this->dispatcher = $dispatcher;
    }
    public function render($uri, Request $request, array $options = array())
    {
        $reference = null;
        if ($uri instanceof ControllerReference) {
            $reference = $uri;
            $attributes = $reference->attributes;
            $reference->attributes = array();
            foreach (array('_format', '_locale') as $key) {
                if (isset($attributes[$key])) {
                    $reference->attributes[$key] = $attributes[$key];
                }
            }
            $uri = $this->generateFragmentUri($uri, $request, false, false);
            $reference->attributes = array_merge($attributes, $reference->attributes);
        }
        $subRequest = $this->createSubRequest($uri, $request);
        if (null !== $reference) {
            $subRequest->attributes->add($reference->attributes);
        }
        $level = ob_get_level();
        try {
            return $this->kernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
        } catch (\Exception $e) {
            if (isset($options['ignore_errors']) && $options['ignore_errors'] && $this->dispatcher) {
                $event = new GetResponseForExceptionEvent($this->kernel, $request, HttpKernelInterface::SUB_REQUEST, $e);
                $this->dispatcher->dispatch(KernelEvents::EXCEPTION, $event);
            }
            Response::closeOutputBuffers($level, false);
            if (isset($options['alt'])) {
                $alt = $options['alt'];
                unset($options['alt']);
                return $this->render($alt, $request, $options);
            }
            if (!isset($options['ignore_errors']) || !$options['ignore_errors']) {
                throw $e;
            }
            return new Response();
        }
    }
    protected function createSubRequest($uri, Request $request)
    {
        $cookies = $request->cookies->all();
        $server = $request->server->all();
        try {
            if ($trustedHeaderName = Request::getTrustedHeaderName(Request::HEADER_CLIENT_IP)) {
                $currentXForwardedFor = $request->headers->get($trustedHeaderName, '');
                $server['HTTP_'.$trustedHeaderName] = ($currentXForwardedFor ? $currentXForwardedFor.', ' : '').$request->getClientIp();
            }
        } catch (\InvalidArgumentException $e) {
        }
        $server['REMOTE_ADDR'] = '127.0.0.1';
        $subRequest = Request::create($uri, 'get', array(), $cookies, array(), $server);
        if ($request->headers->has('Surrogate-Capability')) {
            $subRequest->headers->set('Surrogate-Capability', $request->headers->get('Surrogate-Capability'));
        }
        if ($session = $request->getSession()) {
            $subRequest->setSession($session);
        }
        return $subRequest;
    }
    public function getName()
    {
        return 'inline';
    }
}
