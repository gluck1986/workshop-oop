<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 022 22.07.18
 * Time: 14:33
 */

namespace ConvertFeed\Init;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;
use Zend\ServiceManager\ServiceManager;

class AppInit
{
    public function getApplication(): Application
    {
        $application = new Application('Application console');
        $container = $this->getContainer();
        $commands = $container->get('config')['commands'];
        foreach ($commands as $command) {
            $application->add($container->get($command));
        }
        return $application;
    }

    public function getContainer(): ContainerInterface
    {
        $config = $this->getConfig();
        $container = new ServiceManager($config['dependencies']);
        $container->setService('config', $config);

        return $container;
    }

    private function getConfig(): array
    {
        $path = implode(
            DIRECTORY_SEPARATOR,
            [dirname(dirname(__DIR__)), 'config', '{{,*.}global,{,*.}local}.php']
        );
        $aggregator = new ConfigAggregator([
            new PhpFileProvider($path)
        ]);

        return $aggregator->getMergedConfig();
    }

}
