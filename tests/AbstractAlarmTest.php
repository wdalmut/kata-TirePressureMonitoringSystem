<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class AbstractAlarmTest extends \PHPUnit_Framework_TestCase
{
    public function testInitalStatus()
    {
        $alarm = $this->getMockForAbstractClass("TDDMicroExercises\PHP\TirePressureMonitoringSystem\AbstractAlarm");

        $this->assertFalse($alarm->isAlarm());
        $this->assertSame(0, $alarm->getAlarmCount());
    }

    public function testSetAlarm()
    {
        $alarm = $this->getMockForAbstractClass("TDDMicroExercises\PHP\TirePressureMonitoringSystem\AbstractAlarm");
        $alarm->setAlarm();

        $this->assertTrue($alarm->isAlarm());
        $this->assertSame(1, $alarm->getAlarmCount());
    }

    public function testIncAlarmCount()
    {
        $alarm = $this->getMockForAbstractClass("TDDMicroExercises\PHP\TirePressureMonitoringSystem\AbstractAlarm");

        $alarm->setAlarm();
        $alarm->setAlarm();
        $alarm->setAlarm();

        $this->assertTrue($alarm->isAlarm());
        $this->assertSame(3, $alarm->getAlarmCount());
    }
}
