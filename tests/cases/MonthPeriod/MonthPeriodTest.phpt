<?php declare(strict_types=1);

namespace Tests\Surda\DateTimePeriod\MonthPeriod;

use Carbon\Carbon;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriod;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class MonthPeriodTest extends TestCase
{
    public function testConstructor()
    {
        $carbon = new Carbon();
        $monthPeriod = new MonthPeriod();

        Assert::same($carbon->day, $monthPeriod->day());
        Assert::same($carbon->month, $monthPeriod->month());
        Assert::same($carbon->year, $monthPeriod->year());
    }

    public function testConstructorFromCarbon()
    {
        $monthPeriod = new MonthPeriod(new Carbon('2019-12-31 00:00:00.000000'));

        Assert::same('2019-12-31 00:00:00.000000', $monthPeriod->format('Y-m-d H:i:s.u'));
    }


    public function testFromDateTimeInterface()
    {
        $monthPeriod = MonthPeriod::createFromDateTimeInterface(new \DateTime('2019-12-31'));

        Assert::same('2019-12-31 00:00:00.000000', $monthPeriod->format('Y-m-d H:i:s.u'));
    }

    public function testFromPeriod()
    {
        $monthPeriod = MonthPeriod::createFromPeriod('201912');

        Assert::same('2019-12-01 00:00:00.000000', $monthPeriod->format('Y-m-d H:i:s.u'));
    }


    public function testConvert()
    {
        $monthPeriod = new MonthPeriod(new Carbon('2019-12-15 00:00:00.000000'));

        Assert::same('2019-12-01 00:00:00', $monthPeriod->firstDay()->format('Y-m-d H:i:s'));
        Assert::same('2019-12-31 00:00:00', $monthPeriod->lastDay()->format('Y-m-d H:i:s'));

        Assert::same('2019-11-01 00:00:00', $monthPeriod->firstDayPrevMonth()->format('Y-m-d H:i:s'));
        Assert::same('2019-11-30 00:00:00', $monthPeriod->lastDayPrevMonth()->format('Y-m-d H:i:s'));

        Assert::same('2020-01-01 00:00:00', $monthPeriod->firstDayNextMonth()->format('Y-m-d H:i:s'));
        Assert::same('2020-01-31 00:00:00', $monthPeriod->lastDayNextMonth()->format('Y-m-d H:i:s'));

        Assert::same('2019-12-15 00:00:00.000000', $monthPeriod->format('Y-m-d H:i:s.u'));

        Assert::same('201912', $monthPeriod->period());
        Assert::same('201912', (string) $monthPeriod);

        Assert::same('201911', $monthPeriod->periodPrevMonth());
        Assert::same('202001', $monthPeriod->periodNextMonth());

        Assert::same('2019-12-01 00:00:00', (string) $monthPeriod->firstDayStartOfDay());
        Assert::same('2019-12-31 23:59:59', (string) $monthPeriod->lastDayEndOfDay());

    }
}

(new MonthPeriodTest())->run();