<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class Test extends \PHPUnit_Framework_TestCase
{
    public function testInitalStatus()
    {
        $alarm = new AlarmModel();

        $this->assertFalse($alarm->isAlarm());
        $this->assertSame(0, $alarm->getAlarmCount());
    }

    public function testSetAlarm()
    {
        $alarm = new AlarmModel();
        $alarm->setAlarm();

        $this->assertTrue($alarm->isAlarm());
        $this->assertSame(1, $alarm->getAlarmCount());
    }

    public function testIncAlarmCount()
    {
        $alarm = new AlarmModel();
        $alarm->setAlarm();
        $alarm->setAlarm();
        $alarm->setAlarm();

        $this->assertTrue($alarm->isAlarm());
        $this->assertSame(3, $alarm->getAlarmCount());
    }
}
