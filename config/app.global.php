<?php

use ConvertFeed\Commands\HelloCommand;
use ConvertFeed\Commands\ReadCommand;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'dependencies' => [
        'abstract_factories' => [
           ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            \ConvertFeed\RssConverter::class => function (\Psr\Container\ContainerInterface $container) {
                return new \ConvertFeed\RssConverter($container);
            }
        ],
    ],
    'commands'  => [
        'hello' => HelloCommand::class,
        'read' => ReadCommand::class
    ],
];
