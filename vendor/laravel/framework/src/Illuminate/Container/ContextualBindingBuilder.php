<?php namespace Illuminate\Container;
use Illuminate\Contracts\Container\ContextualBindingBuilder as ContextualBindingBuilderContract;
class ContextualBindingBuilder implements ContextualBindingBuilderContract {
	protected $container;
	protected $concrete;
	public function __construct(Container $container, $concrete)
	{
		$this->concrete = $concrete;
		$this->container = $container;
	}
	public function needs($abstract)
	{
		$this->needs = $abstract;
		return $this;
	}
	public function give($implementation)
	{
		$this->container->addContextualBinding($this->concrete, $this->needs, $implementation);
	}
}