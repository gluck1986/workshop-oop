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
            \ConvertFeed\MainConverter::class => function (\Psr\Container\ContainerInterface $container) {
                return new \ConvertFeed\MainConverter($container);
            }
        ],
    ],
    'commands'  => [
        'hello' => HelloCommand::class,
        'read' => ReadCommand::class
    ],
];
