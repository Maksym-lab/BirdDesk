<?php
namespace Symfony\Component\Finder\Tests\Iterator;
use Symfony\Component\Finder\Iterator\MultiplePcreFilterIterator;
class MultiplePcreFilterIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsRegex($string, $isRegex, $message)
    {
        $testIterator = new TestMultiplePcreFilterIterator();
        $this->assertEquals($isRegex, $testIterator->isRegex($string), $message);
    }
    public function getIsRegexFixtures()
    {
        return array(
            array('foo', false, 'string'),
            array(' foo ', false, '" " is not a valid delimiter'),
            array('\\foo\\', false, '"\\" is not a valid delimiter'),
            array('afooa', false, '"a" is not a valid delimiter'),
            array('
            array('/a/', true, 'valid regex'),
            array('/foo/', true, 'valid regex'),
            array('/foo/i', true, 'valid regex with a single modifier'),
            array('/foo/imsxu', true, 'valid regex with multiple modifiers'),
            array('#foo#', true, '"#" is a valid delimiter'),
            array('{foo}', true, '"{,}" is a valid delimiter pair'),
            array('*foo.*', false, '"*" is not considered as a valid delimiter'),
            array('?foo.?', false, '"?" is not considered as a valid delimiter'),
        );
    }
}
class TestMultiplePcreFilterIterator extends MultiplePcreFilterIterator
{
    public function __construct()
    {
    }
    public function accept()
    {
        throw new \BadFunctionCallException('Not implemented');
    }
    public function isRegex($str)
    {
        return parent::isRegex($str);
    }
    public function toRegex($str)
    {
        throw new \BadFunctionCallException('Not implemented');
    }
}
