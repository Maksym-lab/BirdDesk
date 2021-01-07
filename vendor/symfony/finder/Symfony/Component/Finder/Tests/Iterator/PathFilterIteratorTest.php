<?php
namespace Symfony\Component\Finder\Tests\Iterator;
use Symfony\Component\Finder\Iterator\PathFilterIterator;
class PathFilterIteratorTest extends IteratorTestCase
{
    public function testFilter(\Iterator $inner, array $matchPatterns, array $noMatchPatterns, array $resultArray)
    {
        $iterator = new PathFilterIterator($inner, $matchPatterns, $noMatchPatterns);
        $this->assertIterator($resultArray, $iterator);
    }
    public function getTestFilterData()
    {
        $inner = new MockFileListIterator();
        $inner[] = new MockSplFileInfo(array(
            'name' => 'abc.dat',
            'relativePathname' => 'A'.DIRECTORY_SEPARATOR.'B'.DIRECTORY_SEPARATOR.'C'.DIRECTORY_SEPARATOR.'abc.dat',
        ));
        $inner[] = new MockSplFileInfo(array(
            'name' => 'ab.dat',
            'relativePathname' => 'A'.DIRECTORY_SEPARATOR.'B'.DIRECTORY_SEPARATOR.'ab.dat',
        ));
        $inner[] = new MockSplFileInfo(array(
            'name' => 'a.dat',
            'relativePathname' => 'A'.DIRECTORY_SEPARATOR.'a.dat',
        ));
        $inner[] = new MockSplFileInfo(array(
            'name' => 'abc.dat.copy',
            'relativePathname' => 'copy'.DIRECTORY_SEPARATOR.'A'.DIRECTORY_SEPARATOR.'B'.DIRECTORY_SEPARATOR.'C'.DIRECTORY_SEPARATOR.'abc.dat',
        ));
        $inner[] = new MockSplFileInfo(array(
            'name' => 'ab.dat.copy',
            'relativePathname' => 'copy'.DIRECTORY_SEPARATOR.'A'.DIRECTORY_SEPARATOR.'B'.DIRECTORY_SEPARATOR.'ab.dat',
        ));
        $inner[] = new MockSplFileInfo(array(
            'name' => 'a.dat.copy',
            'relativePathname' => 'copy'.DIRECTORY_SEPARATOR.'A'.DIRECTORY_SEPARATOR.'a.dat',
        ));
        return array(
            array($inner, array('/^A/'),       array(), array('abc.dat', 'ab.dat', 'a.dat')),
            array($inner, array('/^A\/B/'),    array(), array('abc.dat', 'ab.dat')),
            array($inner, array('/^A\/B\/C/'), array(), array('abc.dat')),
            array($inner, array('/A\/B\/C/'),  array(), array('abc.dat', 'abc.dat.copy')),
            array($inner, array('A'),      array(), array('abc.dat', 'ab.dat', 'a.dat', 'abc.dat.copy', 'ab.dat.copy', 'a.dat.copy')),
            array($inner, array('A/B'),    array(), array('abc.dat', 'ab.dat', 'abc.dat.copy', 'ab.dat.copy')),
            array($inner, array('A/B/C'),  array(), array('abc.dat', 'abc.dat.copy')),
            array($inner, array('copy/A'),      array(), array('abc.dat.copy', 'ab.dat.copy', 'a.dat.copy')),
            array($inner, array('copy/A/B'),    array(), array('abc.dat.copy', 'ab.dat.copy')),
            array($inner, array('copy/A/B/C'),  array(), array('abc.dat.copy')),
        );
    }
}