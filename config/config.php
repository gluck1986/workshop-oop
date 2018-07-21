<?php
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;
$aggregator = new ConfigAggregator([
    new PhpFileProvider(__DIR__ . DIRECTORY_SEPARATOR . 'autoload/{{,*.}global,{,*.}local}.php'),
]);
return $aggregator->getMergedConfig();