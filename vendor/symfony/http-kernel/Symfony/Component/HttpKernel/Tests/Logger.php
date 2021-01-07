<?php
namespace Symfony\Component\HttpKernel\Tests;
use Psr\Log\LoggerInterface;
class Logger implements LoggerInterface
{
    protected $logs;
    public function __construct()
    {
        $this->clear();
    }
    public function getLogs($level = false)
    {
        return false === $level ? $this->logs : $this->logs[$level];
    }
    public function clear()
    {
        $this->logs = array(
            'emergency' => array(),
            'alert' => array(),
            'critical' => array(),
            'error' => array(),
            'warning' => array(),
            'notice' => array(),
            'info' => array(),
            'debug' => array(),
        );
    }
    public function log($level, $message, array $context = array())
    {
        $this->logs[$level][] = $message;
    }
    public function emergency($message, array $context = array())
    {
        $this->log('emergency', $message, $context);
    }
    public function alert($message, array $context = array())
    {
        $this->log('alert', $message, $context);
    }
    public function critical($message, array $context = array())
    {
        $this->log('critical', $message, $context);
    }
    public function error($message, array $context = array())
    {
        $this->log('error', $message, $context);
    }
    public function warning($message, array $context = array())
    {
        $this->log('warning', $message, $context);
    }
    public function notice($message, array $context = array())
    {
        $this->log('notice', $message, $context);
    }
    public function info($message, array $context = array())
    {
        $this->log('info', $message, $context);
    }
    public function debug($message, array $context = array())
    {
        $this->log('debug', $message, $context);
    }
    public function emerg($message, array $context = array())
    {
        trigger_error('Use emergency() which is PSR-3 compatible', E_USER_DEPRECATED);
        $this->log('emergency', $message, $context);
    }
    public function crit($message, array $context = array())
    {
        trigger_error('Use critical() which is PSR-3 compatible', E_USER_DEPRECATED);
        $this->log('critical', $message, $context);
    }
    public function err($message, array $context = array())
    {
        trigger_error('Use error() which is PSR-3 compatible', E_USER_DEPRECATED);
        $this->log('error', $message, $context);
    }
    public function warn($message, array $context = array())
    {
        trigger_error('Use warning() which is PSR-3 compatible', E_USER_DEPRECATED);
        $this->log('warning', $message, $context);
    }
}
