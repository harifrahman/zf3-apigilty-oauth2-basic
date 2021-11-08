<?php
namespace Vehicle\V1\Service;

use Vehicle\Entity\Vehicle as VehicleEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\InputFilter\InputFilter as ZendInputFilter;
use Vehicle\V1\VehicleEvent;

class Vehicle
{
    use EventManagerAwareTrait;

    protected $vehicleEvent;

    protected $config;

    public function save(ZendInputFilter $inputFilter)
    {
        $vehicleEvent = new VehicleEvent();
        $vehicleEvent->setInputFilter($inputFilter);
        $vehicleEvent->setName(VehicleEvent::EVENT_CREATE_VEHICLE);
        $create = $this->getEventManager()->triggerEvent($vehicleEvent);
        if ($create->stopped()) {
            $vehicleEvent->setName(VehicleEvent::EVENT_CREATE_VEHICLE_ERROR);
            $vehicleEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($vehicleEvent);
            throw $vehicleEvent->getException();
        } else {
            $vehicleEvent->setName(VehicleEvent::EVENT_CREATE_VEHICLE_SUCCESS);
            $this->getEventManager()->triggerEvent($vehicleEvent);
            return $vehicleEvent->getVehicleEntity();
        }
    }

    /**
     * Update Vehicle
     *
     * @param \Vehicle\Entity\Vehicle  $vehicle
     * @param array                     $updateData
     */
    public function update($vehicle, $inputFilter)
    {
        $vehicleEvent = $this->getVehicleEvent();
        $vehicleEvent->setVehicleEntity($vehicle);

        $vehicleEvent->setUpdateData($inputFilter->getValues());
        $vehicleEvent->setInputFilter($inputFilter);
        $vehicleEvent->setName(VehicleEvent::EVENT_UPDATE_VEHICLE);

        $update = $this->getEventManager()->triggerEvent($vehicleEvent);
        if ($update->stopped()) {
            $vehicleEvent->setName(VehicleEvent::EVENT_UPDATE_VEHICLE_ERROR);
            $vehicleEvent->setException($update->last());
            $this->getEventManager()->triggerEvent($vehicleEvent);
            throw $vehicleEvent->getException();
        } else {
            $vehicleEvent->setName(VehicleEvent::EVENT_UPDATE_VEHICLE_SUCCESS);
            $this->getEventManager()->triggerEvent($vehicleEvent);
            return $vehicleEvent->getVehicleEntity();
        }
    }

    public function delete(VehicleEntity $deletedData)
    {
        $vehicleEvent = new VehicleEvent();
        $vehicleEvent->setUpdateData($deletedData);
        $vehicleEvent->setName(VehicleEvent::EVENT_DELETE_VEHICLE);
        $create = $this->getEventManager()->triggerEvent($vehicleEvent);
        if ($create->stopped()) {
            $vehicleEvent->setName(VehicleEvent::EVENT_DELETE_VEHICLE_ERROR);
            $vehicleEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($vehicleEvent);
            throw $vehicleEvent->getException();
        } else {
            $vehicleEvent->setName(VehicleEvent::EVENT_DELETE_VEHICLE_SUCCESS);
            $this->getEventManager()->triggerEvent($vehicleEvent);
            return true;
        }
    }

    /**
     * Get the value of vehicleEvent
     */
    public function getVehicleEvent()
    {
        if ($this->vehicleEvent == null) {
            $this->vehicleEvent = new VehicleEvent();
        }

        return $this->vehicleEvent;
    }

    /**
     * Set the value of vehicleEvent
     *
     * @return  self
     */
    public function setVehicleEvent($vehicleEvent)
    {
        $this->vehicleEvent = $vehicleEvent;

        return $this;
    }
}
