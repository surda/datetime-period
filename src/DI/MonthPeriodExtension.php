<?php declare(strict_types=1);

namespace Surda\DateTimePeriod\DI;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;
use Surda\DateTimePeriod\MonthPeriod\MonthPeriodControlFactory;

/**
 * @property-read stdClass $config
 */
class MonthPeriodExtension extends CompilerExtension
{
    /** @var array */
    private $templates = [
        'default' => __DIR__ . '/../MonthPeriod/Templates/bootstrap4.default.latte',
    ];

    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'useAjax' => Expect::bool(FALSE),
            'template' => Expect::string()->nullable()->default(NULL),
            'templates' => Expect::array()->default([]),
        ]);
    }

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $config = $this->config;

        $definition = $builder->addFactoryDefinition($this->prefix('factory'))
            ->setImplement(MonthPeriodControlFactory::class)
            ->getResultDefinition();

        $definition->addSetup($config->useAjax === TRUE ? 'enableAjax' : 'disableAjax');

        $templates = $config->templates === [] ? $this->templates : $config->templates;

        foreach ($templates as $type => $templateFile) {
            $definition->addSetup('setTemplateByType', [$type, $templateFile]);
        }

        if ($config->template !== NULL) {
            $definition->addSetup('setTemplate', [$config->template]);
        }
    }
}