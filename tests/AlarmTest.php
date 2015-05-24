<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class AlarmTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateAlarm()
    {
        $alarm = new Alarm();

        $this->assertInstanceOf("TDDMicroExercises\PHP\TirePressureMonitoringSystem\Alarm", $alarm);
    }

    public function testAlarmIsOff()
    {
        $alarm = new Alarm();
        $mock = $this->getMockBuilder("TDDMicroExercises\PHP\TirePressureMonitoringSystem\Sensor")->getMock();
        $mock->method("popNextPressurePsiValue")->willReturn(Alarm::HIGH_PRESSURE_TRESHOLD);
        $alarm = new Alarm($mock);
        $this->assertFalse($alarm->isAlarm());
    }

    public function testAlarmHighPressure()
    {
        $mock = $this->getMockBuilder("TDDMicroExercises\PHP\TirePressureMonitoringSystem\Sensor")->getMock();
        $mock->method("popNextPressurePsiValue")->willReturn(Alarm::HIGH_PRESSURE_TRESHOLD+1);
        $alarm = new Alarm($mock);

        $alarm->isAlarm();
        $this->assertTrue($alarm->isAlarm());
    }

    public function testAlarmLowPressure()
    {
        $mock = $this->getMockBuilder("TDDMicroExercises\PHP\TirePressureMonitoringSystem\Sensor")->getMock();
        $mock->method("popNextPressurePsiValue")->willReturn(Alarm::LOW_PRESSURE_TRESHOLD-1);
        $alarm = new Alarm($mock);

        $alarm->isAlarm();
        $this->assertTrue($alarm->isAlarm());
    }

    public function testAlarmCount()
    {
        $mock = $this->getMockBuilder("TDDMicroExercises\PHP\TirePressureMonitoringSystem\Sensor")->getMock();
        $mock->method("popNextPressurePsiValue")->willReturn(Alarm::LOW_PRESSURE_TRESHOLD-1);
        $alarm = new Alarm($mock);

        $alarm->isAlarm();
        $alarm->isAlarm();
        $alarm->isAlarm();
        $alarm->isAlarm();
        $alarm->isAlarm();

        $this->assertSame(5, $alarm->getAlarmCount());
    }

    /**
     * @dataProvider getPressures
     * @group integration
     */
    public function testSensorOverrideInAlarm($pressure, $alarmStatus, $alarmCount)
    {
        $sensor = new Sensor(function() use ($pressure) { return $pressure; });
        $alarm = new Alarm($sensor);

        $alarm->isAlarm();
        $alarm->isAlarm();
        $alarm->isAlarm();
        $alarm->isAlarm();
        $alarm->isAlarm();

        $this->assertSame($alarmStatus, $alarm->isAlarm());
        $this->assertSame($alarmCount, $alarm->getAlarmCount());
    }

    public function getPressures()
    {
        $high = Alarm::HIGH_PRESSURE_TRESHOLD+1;
        $low = Alarm::LOW_PRESSURE_TRESHOLD-1;
        $safe = Alarm::HIGH_PRESSURE_TRESHOLD - (Alarm::HIGH_PRESSURE_TRESHOLD-Alarm::LOW_PRESSURE_TRESHOLD)/2;

        return [
            [$high, true, 6],
            [$low, true, 6],
            [$safe, false, 0],
        ];
    }
}
