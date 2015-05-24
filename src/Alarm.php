<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class Alarm
{
    const LOW_PRESSURE_TRESHOLD     = 17;
    const HIGH_PRESSURE_TRESHOLD    = 21;

    private $sensor;
    private $alarm;

    public function __construct(Sensor $sensor = null, AlarmModel $alarm = null) {
        $this->sensor = ($sensor) ? $sensor : new Sensor();
        $this->alarm = ($alarm) ? $alarm : new AlarmModel();
    }

    public function isAlarm()
    {
        $this->check();
        return $this->alarm->isAlarm();
    }

    public function getAlarmCount()
    {
        return $this->alarm->getAlarmCount();
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
            $this->alarm->setAlarm();
        }

        return $this;
    }
}
