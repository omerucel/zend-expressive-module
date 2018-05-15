<?php

namespace OU\Console\Helper;

use DI\Container;
use Symfony\Component\Console\Helper\Helper;

class ContainerHelper extends Helper
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }


    public function getName()
    {
        return 'container';
    }
}
