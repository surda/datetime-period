<?php declare(strict_types=1);

namespace Tests\Surda\DateTimePeriod\MonthPeriod;

use Nette\DI\Container;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriod;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriodControl;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriodControlFactory;
use Tester\Assert;
use Tester\TestCase;
use Tests\Surda\DateTimePeriod\ContainerFactory;

require __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class MonthPeriodControlTest extends TestCase
{
    public function testControl()
    {
        $config = [
            'monthPeriod' => []
        ];

        /** @var Container $container */
        $container = (new ContainerFactory())->create($config, 1);

        /** @var MonthPeriodControlFactory $factory */
        $factory = $container->getService('monthPeriod.factory');

        /** @var MonthPeriodControl $control */
        $control = $factory->create();

        Assert::true($control->getMonthPeriod() instanceof MonthPeriod);
    }
}

(new MonthPeriodControlTest())->run();