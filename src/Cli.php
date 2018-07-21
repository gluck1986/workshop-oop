<?php
namespace ConvertFeed\Cli;

require_once '_bootstrap.php';

use Symfony\Component\Console\Application;

/** @var \Interop\Container\ContainerInterface $container */

$container = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'container.php';
$application = new Application('Application console');

$commands = $container->get('config')['commands'];
foreach ($commands as $command) {
    $application->add($container->get($command));
}

$application->run();