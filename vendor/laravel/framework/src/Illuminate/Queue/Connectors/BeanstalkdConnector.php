<?php namespace Illuminate\Queue\Connectors;
use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;
use Illuminate\Queue\BeanstalkdQueue;
class BeanstalkdConnector implements ConnectorInterface {
	public function connect(array $config)
	{
		$pheanstalk = new Pheanstalk($config['host'], array_get($config, 'port', PheanstalkInterface::DEFAULT_PORT));
		return new BeanstalkdQueue(
			$pheanstalk, $config['queue'], array_get($config, 'ttr', Pheanstalk::DEFAULT_TTR)
		);
	}
}
