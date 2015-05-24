<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class Alarm extends AbstractAlarm
{
    const LOW_PRESSURE_TRESHOLD     = 17;
    const HIGH_PRESSURE_TRESHOLD    = 21;

    private $sensor;

    public function __construct(Sensor $sensor = null) {
        parent::__construct();
        $this->sensor = ($sensor) ? $sensor : new Sensor();
    }

    public function isAlarm()
    {
        $this->check();
        return parent::isAlarm();
    }

    private function isAlarmWith($psiPressureValue)
    {
        return ($this->isLowPressure($psiPressureValue) || $this->isHighPressure($psiPressureValue));
    }

    private function isHighPressure($psiPressureValue)
    {
        return Alarm::HIGH_PRESSURE_TRESHOLD < $psiPressureValue;
    }

    private function isLowPressure($psiPressureValue)
    {
        return Alarm::LOW_PRESSURE_TRESHOLD > $psiPressureValue;
    }

    private function check()
    {
        $psiPressureValue = $this->sensor->popNextPressurePsiValue();

        if ($this->isAlarmWith($psiPressureValue)) {
            $this->setAlarm();
        }

        return $this;
    }
}
