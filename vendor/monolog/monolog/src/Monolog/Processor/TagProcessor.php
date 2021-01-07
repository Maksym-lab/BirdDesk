<?php
namespace Monolog\Processor;
class TagProcessor
{
    private $tags;
    public function __construct(array $tags = array())
    {
        $this->tags = $tags;
    }
    public function __invoke(array $record)
    {
        $record['extra']['tags'] = $this->tags;
        return $record;
    }
}