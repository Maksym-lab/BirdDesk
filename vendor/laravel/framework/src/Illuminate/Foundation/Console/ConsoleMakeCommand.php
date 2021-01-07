<?php namespace Illuminate\Foundation\Console;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
class ConsoleMakeCommand extends GeneratorCommand {
	protected $name = 'make:console';
	protected $description = "Create a new Artisan command";
	protected $type = 'Console command';
	protected function replaceClass($stub, $name)
	{
		$stub = parent::replaceClass($stub, $name);
		return str_replace('{{command}}', $this->option('command'), $stub);
	}
	protected function getStub()
	{
		return __DIR__.'/stubs/console.stub';
	}
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace.'\Console\Commands';
	}
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'The name of the command.'),
		);
	}
	protected function getOptions()
	{
		return array(
			array('command', null, InputOption::VALUE_OPTIONAL, 'The terminal command that should be assigned.', 'command:name'),
		);
	}
}
