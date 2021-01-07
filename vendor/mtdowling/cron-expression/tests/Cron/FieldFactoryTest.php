<?php
namespace Cron\Tests;
use Cron\FieldFactory;
class FieldFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testRetrievesFieldInstances()
    {
        $mappings = array(
            0 => 'Cron\MinutesField',
            1 => 'Cron\HoursField',
            2 => 'Cron\DayOfMonthField',
            3 => 'Cron\MonthField',
            4 => 'Cron\DayOfWeekField',
            5 => 'Cron\YearField'
        );
        $f = new FieldFactory();
        foreach ($mappings as $position => $class) {
            $this->assertEquals($class, get_class($f->getField($position)));
        }
    }
    public function testValidatesFieldPosition()
    {
        $f = new FieldFactory();
        $f->getField(-1);
    }
}
