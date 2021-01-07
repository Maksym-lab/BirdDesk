<?php
namespace Symfony\Component\EventDispatcher\Tests;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
class EventTest extends \PHPUnit_Framework_TestCase
{
    protected $event;
    protected $dispatcher;
    protected function setUp()
    {
        $this->event = new Event();
        $this->dispatcher = new EventDispatcher();
    }
    protected function tearDown()
    {
        $this->event = null;
        $this->dispatcher = null;
    }
    public function testIsPropagationStopped()
    {
        $this->assertFalse($this->event->isPropagationStopped());
    }
    public function testStopPropagationAndIsPropagationStopped()
    {
        $this->event->stopPropagation();
        $this->assertTrue($this->event->isPropagationStopped());
    }
    public function testLegacySetDispatcher()
    {
        $this->iniSet('error_reporting', -1 & ~E_USER_DEPRECATED);
        $this->event->setDispatcher($this->dispatcher);
        $this->assertSame($this->dispatcher, $this->event->getDispatcher());
    }
    public function testLegacyGetDispatcher()
    {
        $this->iniSet('error_reporting', -1 & ~E_USER_DEPRECATED);
        $this->assertNull($this->event->getDispatcher());
    }
    public function testLegacyGetName()
    {
        $this->iniSet('error_reporting', -1 & ~E_USER_DEPRECATED);
        $this->assertNull($this->event->getName());
    }
    public function testLegacySetName()
    {
        $this->iniSet('error_reporting', -1 & ~E_USER_DEPRECATED);
        $this->event->setName('foo');
        $this->assertEquals('foo', $this->event->getName());
    }
}
