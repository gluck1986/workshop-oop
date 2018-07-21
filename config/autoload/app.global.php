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

        ],
    ],
    'commands'  => [
        'hello' => HelloCommand::class,
        'read' => ReadCommand::class
    ],
];