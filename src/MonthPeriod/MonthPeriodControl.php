<?php declare(strict_types=1);

namespace Surda\DateTimePeriod\MonthPeriod;

use Nette\Application\BadRequestException;
use Nette\Application\UI\Control;
use Nette\Application\UI\ITemplate;
use Surda\UI\Control\ThemeableControls;

/**
 * @method onChange(MonthPeriodControl $param, MonthPeriod $monthPeriod)
 */
class MonthPeriodControl extends Control
{
    use ThemeableControls;

    /**
     * @var string
     * @persistent
     */
    public $period;

    /** @var MonthPeriod */
    protected $monthPeriod;

    /** @var bool */
    protected $useAjax = FALSE;

    /** @var array */
    public $onChange;

    /**
     * @param string $templateType
     */
    public function render(string $templateType = 'default'): void
    {
        /** @var ITemplate $template */
        $template = $this->template;

        $template->setFile($this->getTemplateByType($templateType));

        $template->monthPeriod = $this->getMonthPeriod();
        $template->monthPeriodNow = new MonthPeriod();
        $template->useAjax = $this->useAjax;

        $template->render();
    }

    public function handleChange(?string $period = NULL): void
    {
        if ($period === NULL || $period === '') {
            $this->monthPeriod = new MonthPeriod();
        } else {
            $this->monthPeriod = MonthPeriod::createFromPeriod($period);
        }

        if ($this->useAjax) {
            $this->redrawControl('MonthPeriodSnippet');
        }

        $this->onChange($this, $this->monthPeriod);
    }

    public function enableAjax(): void
    {
        $this->useAjax = TRUE;
    }

    public function disableAjax(): void
    {
        $this->useAjax = FALSE;
    }

    /**
     * @return MonthPeriod
     */
    public function getMonthPeriod(): MonthPeriod
    {
        if ($this->period === NULL) {
            $this->monthPeriod = new MonthPeriod();
        }

        return $this->monthPeriod;
    }

    /**
     * @param MonthPeriod $monthPeriod
     */
    public function setMonthPeriod(MonthPeriod $monthPeriod): void
    {
        $this->monthPeriod = $monthPeriod;
    }

    /**
     * @param array $params
     * @throws BadRequestException
     */
    public function loadState(array $params): void
    {
        parent::loadState($params);

        if ($this->period === NULL) {
            $this->setMonthPeriod(new MonthPeriod());
        } else {
            $this->setMonthPeriod(MonthPeriod::createFromPeriod($this->period));
        }
    }
}