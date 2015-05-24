<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class Sensor
{
    private $placeholder;

    public function __construct(callable $placeholder = null)
    {
        $this->placeholder = ($placeholder) ? $placeholder : new Placeholder();
    }

    public function popNextPressurePsiValue()
    {
        $placeholder = $this->placeholder;
        return $placeholder();
    }
}
