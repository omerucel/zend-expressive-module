<?php

namespace OU\Factory;

use Zend\Config\Config;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Twig\TwigExtension;

class TwigFactory
{
    public static function factory(
        ServerUrlHelper $serverUrlHelper,
        UrlHelper $urlHelper,
        Config $config
    ) {
        $loader = new \Twig_Loader_Filesystem($config->twig->default_template_path);
        $twig = new \Twig_Environment($loader, $config->twig->options->toArray());
        self::registerModuleTemplates($loader, $config);
        $twig->addExtension(
            new TwigExtension(
                $serverUrlHelper,
                $urlHelper,
                $config->twig->assets_url,
                $config->twig->assets_version,
                $config->twig->globals->toArray()
            )
        );
        return $twig;
    }

    /**
     * @param \Twig_Loader_Filesystem $loader
     * @param Config $config
     */
    protected static function registerModuleTemplates(\Twig_Loader_Filesystem $loader, Config $config)
    {
        foreach ($config->modules->toArray() as $path => $moduleClass) {
            $modulePath = str_replace('\\', '/', $moduleClass);
            $moduleName = str_replace('Module', '', basename($modulePath));
            $templateDir = $config->basePath . '/src/' . dirname($modulePath) . '/Resources/templates';
            if (is_dir($templateDir)) {
                $loader->addPath($templateDir, $moduleName);
            }
        }
    }
}
