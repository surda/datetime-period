<?php declare(strict_types=1);

namespace Surda\DateTimePeriod\MonthPeriod;

use Carbon\Carbon;
use DateTimeInterface;
use Surda\DateTimePeriod\Exception\InvalidArgumentException;

class MonthPeriod
{
    /** @var Carbon */
    private $current;

    /**
     * @param Carbon|null $carbon
     */
    public function __construct(?Carbon $carbon = NULL)
    {
        if ($carbon === NULL) {
            $this->current = new Carbon('now');
        } else {
            $this->current = $carbon->copy();
        }
    }

    /**
     * @param DateTimeInterface $datetime
     * @return MonthPeriod
     */
    public static function createFromDateTimeInterface(DateTimeInterface $datetime): MonthPeriod
    {
        return new MonthPeriod(new Carbon($datetime->format('Y-m-d H:i:s.u')));
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @return MonthPeriod
     */
    public static function createFromDate(int $year, int $month, int $day): MonthPeriod
    {
        return new MonthPeriod(Carbon::createFromDate($year, $month, $day));
    }


    /**
     * @param string $period 'yyyymm'
     * @return MonthPeriod
     */
    public static function createFromPeriod(string $period): MonthPeriod
    {
        if (FALSE === (bool) preg_match("/^([12]\d{3}(0[1-9]|1[0-2]))$/", $period)) {
            throw new InvalidArgumentException();
        }

        $datetime = sprintf('%s-%s-01 00:00:00.000000', substr($period, 0, 4), substr($period, 4, 2));

        /** @var Carbon $carbon */
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s.u', $datetime);

        return new MonthPeriod($carbon);
    }

    /**
     * @return Carbon
     */
    public function firstDay(): Carbon
    {
        return new Carbon(sprintf('first day of %s', $this->current->format('F Y')));
    }

    /**
     * @return Carbon
     */
    public function lastDay(): Carbon
    {
        return new Carbon(sprintf('last day of %s', $this->current->format('F Y')));
    }

    /**
     * @return Carbon
     */
    public function firstDayPrevMonth(): Carbon
    {
        $d = $this->current->copy();
        $d->modify('first day of previous month');

        return $d;
    }

    /**
     * @return Carbon
     */
    public function lastDayPrevMonth(): Carbon
    {
        $d = $this->current->copy();
        $d->modify('last day of previous month');

        return $d;
    }

    /**
     * @return Carbon
     */
    public function firstDayNextMonth(): Carbon
    {
        $d = $this->current->copy();
        $d->modify('first day of next month');

        return $d;
    }

    /**
     * @return Carbon
     */
    public function lastDayNextMonth(): Carbon
    {
        $d = $this->current->copy();
        $d->modify('last day of next month');

        return $d;
    }

    /**
     * @param string $format
     * @return string
     */
    public function format(string $format): string
    {
        $d = $this->current->copy();

        return $d->format($format);
    }

    /**
     * @return string 'yyyyrr'
     */
    public function period(): string
    {
        $d = $this->current->copy();

        return $d->format('Ym');
    }

    public function __toString()
    {
        return $this->period();
    }


    /**
     * @return string 'yyyyrr'
     */
    public function periodPrevMonth(): string
    {
        $d = $this->current->copy();
        $d->modify('first day of previous month');

        return $d->format('Ym');
    }

    /**
     * @return string 'yyyyrr'
     */
    public function periodNextMonth(): string
    {
        $d = $this->current->copy();
        $d->modify('first day of next month');

        return $d->format('Ym');
    }

    /**
     * @return int
     */
    public function day(): int
    {
        return $this->current->day;
    }

    /**
     * @return int
     */
    public function month(): int
    {
        return $this->current->month;
    }

    /**
     * @return int
     */
    public function year(): int
    {
        return $this->current->year;
    }

    /**
     * @return Carbon
     */
    public function firstDayStartOfDay(): Carbon
    {
        return $this->firstDay()->startOfDay();
    }

    /**
     * @return Carbon
     */
    public function lastDayEndOfDay(): Carbon
    {
        return $this->lastDay()->endOfDay();
    }
}
