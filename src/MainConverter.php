<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 022 22.07.18
 * Time: 9:52
 */

namespace ConvertFeed;

use ConvertFeed\Services\Converter\Converter;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Zend\ServiceManager\ServiceManager;

class MainConverter
{
    private $container;

    public function __construct(ContainerInterface $container = null)
    {
        if (is_null($container)) {
            $container = new ServiceManager(

                [
                    'abstract_factories' => [
                        ReflectionBasedAbstractFactory::class,
                    ],
                    'factories' => [

                    ],
                ]
            );
        }
        $this->container = $container;
    }

    public function convert(string $xml, string $format): string
    {
        /** @var Converter $converter */
        $converter = $this->container->get(Converter::class);

        return $converter->convert($xml, $format);
    }
}