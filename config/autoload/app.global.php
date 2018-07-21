<?php

return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [

        ],
    ],
    'commands'  => [
        'hello' => \ConvertFeed\Commands\HelloAction::class
    ],
];