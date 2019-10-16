<?php declare(strict_types=1);

namespace Surda\DateTimePeriod\MonthPeriod;

trait TMonthPeriod
{
    /** @var MonthPeriodControlFactory */
    private $monthPeriodControlFactory;

    /**
     * @param MonthPeriodControlFactory $monthPeriodControlFactory
     */
    public function injectMonthPeriodControlFactory(MonthPeriodControlFactory $monthPeriodControlFactory): void
    {
        $this->monthPeriodControlFactory = $monthPeriodControlFactory;
    }

    /**
     * @return MonthPeriodControl
     */
    protected function createComponentMp(): MonthPeriodControl
    {
        return $this->monthPeriodControlFactory->create();
    }
}