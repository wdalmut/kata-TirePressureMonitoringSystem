<?php
namespace TDDMicroExercises\PHP\TirePressureMonitoringSystem;

class Placeholder
{
    const OFFSET = 16;

    public function __invoke()
    {
        // placeholder implementation that simulate a real sensor in a real tire
        $pressureTelemetryValue = floor(6 * rand() * rand());
        return self::OFFSET + $pressureTelemetryValue;
    }
}
