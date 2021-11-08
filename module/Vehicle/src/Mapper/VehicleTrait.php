<?php

namespace Vehicle\Mapper;

/**
 * @author Arif Rahman Hakim <harifrahman999@gmail.com>
 *
 * Vehicle Trait
 */
trait VehicleTrait
{
    /**
     * @var \Vehicle\Mapper\Vehicle
     */
    protected $vehicleMapper;

    /**
     * Get the value of vehicleMapper
     *
     * @return  \Vehicle\Mapper\Vehicle
     */ 
    public function getVehicleMapper()
    {
        return $this->vehicleMapper;
    }

    /**
     * Set the value of vehicleMapper
     *
     * @param  \Vehicle\Mapper\Vehicle  $vehicleMapper
     *
     * @return  self
     */ 
    public function setVehicleMapper(\Vehicle\Mapper\Vehicle $vehicleMapper)
    {
        $this->vehicleMapper = $vehicleMapper;

        return $this;
    }
}
