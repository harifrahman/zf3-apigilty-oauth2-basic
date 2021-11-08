<?php
namespace Vehicle\V1\Rest\Vehicle;

class VehicleResourceFactory
{
    public function __invoke($services)
    {
        $vehicleMapper = $services->get(\Vehicle\Mapper\Vehicle::class);
        $vehicleService = $services->get(\Vehicle\V1\Service\Vehicle::class);
        $resource = new VehicleResource(
            $vehicleMapper
        );
        $resource->setVehicleService($vehicleService);
        return $resource;
    }
}
