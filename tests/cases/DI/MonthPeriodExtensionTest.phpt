<?php declare(strict_types=1);

namespace Tests\Surda\DateTimePeriod;

use Nette\DI\Container;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriodControlFactory;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class MonthPeriodExtensionTest extends TestCase
{
    public function testRegistration()
    {
        /** @var Container $container */
        $container = (new ContainerFactory())->create([]);

        /** @var MonthPeriodControlFactory $factory */
        $factory = $container->getService('monthPeriod.factory');
        Assert::true($factory instanceof MonthPeriodControlFactory);

        /** @var MonthPeriodControlFactory $factory */
        $factory = $container->getByType(MonthPeriodControlFactory::class);
        Assert::true($factory instanceof MonthPeriodControlFactory);
    }
}

(new MonthPeriodExtensionTest())->run();