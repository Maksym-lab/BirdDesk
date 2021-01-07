<?php
namespace Psy\Reflection;
class ReflectionConstant implements \Reflector
{
    private $class;
    private $name;
    private $value;
    public function __construct($class, $name)
    {
        if (! $class instanceof \ReflectionClass) {
            $class = new \ReflectionClass($class);
        }
        $this->class = $class;
        $this->name  = $name;
        $constants = $class->getConstants();
        if (!array_key_exists($name, $constants)) {
            throw new \InvalidArgumentException('Unknown constant: ' . $name);
        }
        $this->value = $constants[$name];
    }
    public function getDeclaringClass()
    {
        return $this->class;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function getFileName()
    {
        return;
    }
    public function getStartLine()
    {
        throw new \RuntimeException('Not yet implemented because it\'s unclear what I should do here :)');
    }
    public function getEndLine()
    {
        return $this->getStartLine();
    }
    public function getDocComment()
    {
        return false;
    }
    public static function export()
    {
        throw new \RuntimeException('Not yet implemented because it\'s unclear what I should do here :)');
    }
    public function __toString()
    {
        return $this->getName();
    }
}