<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class SensorTest extends \PHPUnit_Framework_TestCase
{
    public function testSamplePressure()
    {
        $sensor = new Sensor();

        $this->assertInternalType("float", $sensor->popNextPressurePsiValue());
    }

    public function testNewSampler()
    {
        $sensor = new Sensor(function() { return 5.0; });

        $this->assertSame(5.0, $sensor->popNextPressurePsiValue());
    }
}
