<?php declare(strict_types=1);

namespace Surda\DateTimePeriod\MonthPeriod;

interface MonthPeriodControlFactory
{
    /**
     * @return MonthPeriodControl
     */
    public function create(): MonthPeriodControl;
}
