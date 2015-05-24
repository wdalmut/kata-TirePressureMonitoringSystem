<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class AlarmModel
{
    private $alarmOn;
    private $alarmCount;

    public function __construct()
    {
        $this->resetAlarm();
    }

    private function resetAlarm()
    {
        $this->setAlarmStatus(false);
        $this->alarmCount = 0;
    }

    public function setAlarm()
    {
        $this->setAlarmStatus(true);
        $this->alarmCount += 1;
    }

    private function setAlarmStatus($status)
    {
        $this->alarmOn = $status;
    }

    public function getAlarmCount()
    {
        return $this->alarmCount;
    }

    public function isAlarm()
    {
        return $this->alarmOn;
    }
}
