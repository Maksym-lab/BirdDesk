<?php
namespace Symfony\Component\Finder\Tests\Iterator;
abstract class IteratorTestCase extends \PHPUnit_Framework_TestCase
{
    protected function assertIterator($expected, \Traversable $iterator)
    {
        $values = array_map(function (\SplFileInfo $fileinfo) { return str_replace('/', DIRECTORY_SEPARATOR, $fileinfo->getPathname()); }, iterator_to_array($iterator, false));
        $expected = array_map(function ($path) { return str_replace('/', DIRECTORY_SEPARATOR, $path); }, $expected);
        sort($values);
        sort($expected);
        $this->assertEquals($expected, array_values($values));
    }
    protected function assertOrderedIterator($expected, \Traversable $iterator)
    {
        $values = array_map(function (\SplFileInfo $fileinfo) { return $fileinfo->getPathname(); }, iterator_to_array($iterator));
        $this->assertEquals($expected, array_values($values));
    }
    protected function assertOrderedIteratorForGroups($expected, \Traversable $iterator)
    {
        $values = array_values(array_map(function (\SplFileInfo $fileinfo) { return $fileinfo->getPathname(); }, iterator_to_array($iterator)));
        foreach ($expected as $subarray) {
            $temp = array();
            while (count($values) && count($temp) < count($subarray)) {
                array_push($temp, array_shift($values));
            }
            sort($temp);
            sort($subarray);
            $this->assertEquals($subarray, $temp);
        }
    }
    protected function assertIteratorInForeach($expected, \Traversable $iterator)
    {
        $values = array();
        foreach ($iterator as $file) {
            $this->assertInstanceOf('Symfony\\Component\\Finder\\SplFileInfo', $file);
            $values[] = $file->getPathname();
        }
        sort($values);
        sort($expected);
        $this->assertEquals($expected, array_values($values));
    }
    protected function assertOrderedIteratorInForeach($expected, \Traversable $iterator)
    {
        $values = array();
        foreach ($iterator as $file) {
            $this->assertInstanceOf('Symfony\\Component\\Finder\\SplFileInfo', $file);
            $values[] = $file->getPathname();
        }
        $this->assertEquals($expected, array_values($values));
    }
}
