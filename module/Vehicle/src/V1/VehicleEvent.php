<?php

namespace Vehicle\V1;

use Zend\EventManager\Event;
use Zend\InputFilter\InputFilterInterface;
use \Exception;
use Vehicle\Entity\Vehicle as VehicleEntity;

class VehicleEvent extends Event
{
    /**#@+
    * Vehicle events triggered by eventmanager
    */

    const EVENT_CREATE_VEHICLE         = 'create.vehicle';
    const EVENT_CREATE_VEHICLE_ERROR   = 'create.vehicle.error';
    const EVENT_CREATE_VEHICLE_SUCCESS = 'create.vehicle.success';

    const EVENT_UPDATE_VEHICLE         = 'update.vehicle';
    const EVENT_UPDATE_VEHICLE_ERROR   = 'update.vehicle.error';
    const EVENT_UPDATE_VEHICLE_SUCCESS = 'update.vehicle.success';

    const EVENT_DELETE_VEHICLE         = 'delete.vehicle';
    const EVENT_DELETE_VEHICLE_ERROR   = 'delete.vehicle.error';
    const EVENT_DELETE_VEHICLE_SUCCESS = 'delete.vehicle.success';

    /**#@-*/

    /**
     * @var VehicleEntity
     */
    protected $vehicleEntity;

    /**
     * @var Zend\InputFilter\InputFilterInterface
     */
    protected $inputFilter;

    /**
     * @var \Exception
     */
    protected $exception;

    protected $updateData;

    /**
     * @return the $inputFilter
     */
    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    /**
     * @param Zend\InputFilter\InputFilterInterface $inputFilter
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return the $exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     */
    public function setException(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Get the value of updateData
     */ 
    public function getUpdateData()
    {
        return $this->updateData;
    }

    /**
     * Set the value of updateData
     *
     * @return  self
     */ 
    public function setUpdateData($updateData)
    {
        $this->updateData = $updateData;

        return $this;
    }

    /**
     * Get the value of vehicleEntity
     *
     * @return  VehicleEntity
     */ 
    public function getVehicleEntity()
    {
        return $this->vehicleEntity;
    }

    /**
     * Set the value of vehicleEntity
     *
     * @param  VehicleEntity  $vehicleEntity
     *
     * @return  self
     */ 
    public function setVehicleEntity(VehicleEntity $vehicleEntity)
    {
        $this->vehicleEntity = $vehicleEntity;

        return $this;
    }
}
