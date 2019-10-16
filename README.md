# Datetime period control for Nette Framework 

-----

[![Build Status](https://travis-ci.org/surda/datetime-period.svg?branch=master)](https://travis-ci.org/surda/datetime-period)
[![Licence](https://img.shields.io/packagist/l/surda/datetime-period.svg?style=flat-square)](https://packagist.org/packages/surda/datetime-period)
[![Latest stable](https://img.shields.io/packagist/v/surda/datetime-period.svg?style=flat-square)](https://packagist.org/packages/surda/datetime-period)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)


## Installation

The recommended way to is via Composer:

```
composer require surda/datetime-period
```

After that you have to register extension in config.neon:

```yaml
extensions:
    monthPeriod: Surda\DateTimePeriod\DI\MonthPeriodExtension
```

## Configuration

Default
```yaml
monthPeriod:
    templates:
        default: bootstrap4.default.latte
    useAjax: FALSE
```

## Usage

Presenter

```php
use Surda\DateTimePeriod\MonthPeriod\MonthPeriod;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriodControl;
use Surda\DateTimePeriod\MonthPeriod\TMonthPeriod;

class ProductPresenter extends Nette\Application\UI\Presenter
{
    use TMonthPeriod;

    public function actionDefault(): void
    {
        /** @var MonthPeriodControl $mp */
        $mp = $this->getComponent('mp');

        /** @var MonthPeriod $monthPeriod */
        $monthPeriod = $mp->getMonthPeriod();
    }
}
```
Template

```html
{control mp} or {control mp template} 
```

## Custom options

```php
class ProductPresenter extends Nette\Application\UI\Presenter
{
    /**
     * @return MonthPeriodControl
     */
    protected function createComponentMp(): MonthPeriodControl
    {
        $control = $this->monthPeriodControlFactory->create();

        $control->onChange[] = function (MonthPeriodControl $control, MonthPeriod $monthPeriod): void {
            $this->redirect('this');
        };

        return $control;
    }
}
```