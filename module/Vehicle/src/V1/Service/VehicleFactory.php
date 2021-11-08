<?php
namespace Vehicle\V1\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class VehicleFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $vehicleService = new Vehicle();
        return $vehicleService;
    }
}
