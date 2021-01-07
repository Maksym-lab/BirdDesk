<?php
namespace Symfony\Component\HttpKernel\Tests\Fixtures;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
class TestEventDispatcher extends EventDispatcher implements TraceableEventDispatcherInterface
{
    public function getCalledListeners()
    {
        return array('foo');
    }
    public function getNotCalledListeners()
    {
        return array('bar');
    }
}
