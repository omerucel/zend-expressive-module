<?php

namespace OU\Console\Helper\Doctrine;

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\OutputWriter;
use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelperInterface;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputInterface;

class ConfigurationHelper extends Helper implements ConfigurationHelperInterface
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * ConfigurationHelper constructor.
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }


    /**
     * @param InputInterface $input
     * @param OutputWriter $outputWriter
     * @return Configuration
     */
    public function getMigrationConfig(InputInterface $input, OutputWriter $outputWriter)
    {
        return $this->configuration;
    }

    public function getName()
    {
        return 'configuration';
    }
}
