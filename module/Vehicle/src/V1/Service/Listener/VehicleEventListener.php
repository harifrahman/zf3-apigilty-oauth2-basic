<?php
namespace Vehicle\V1\Service\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use Vehicle\Mapper\VehicleTrait as VehicleMapperTrait;
use Vehicle\Entity\Vehicle as VehicleEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Vehicle\V1\VehicleEvent;
use Zend\Log\Exception\RuntimeException;

class VehicleEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use EventManagerAwareTrait;
    use LoggerAwareTrait;
    use VehicleMapperTrait;

    protected $vehicleEvent;
    protected $vehicleHydrator;

    public function __construct(
        \Vehicle\Mapper\Vehicle $vehicleMapper
    ) {
        $this->setVehicleMapper($vehicleMapper);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            VehicleEvent::EVENT_CREATE_VEHICLE,
            [$this, 'createVehicle'],
            500
        );

        $this->listeners[] = $events->attach(
            VehicleEvent::EVENT_UPDATE_VEHICLE,
            [$this, 'updateVehicle'],
            500
        );

        $this->listeners[] = $events->attach(
            VehicleEvent::EVENT_DELETE_VEHICLE,
            [$this, 'deleteVehicle'],
            500
        );
    }

    public function createVehicle(VehicleEvent $event)
    {
        try {
            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            $bodyRequest = $event->getInputFilter()->getValues();
            $vehicleEntity = new VehicleEntity;
            $hydrateEntity  = $this->getVehicleHydrator()->hydrate($bodyRequest, $vehicleEntity);
            $entityResult   = $this->getVehicleMapper()->save($hydrateEntity);
            $event->setVehicleEntity($entityResult);
        } catch (RuntimeException $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function updateVehicle(VehicleEvent $event)
    {
        try {
            $vehicleEntity = $event->getVehicleEntity();
            $vehicleEntity->setUpdatedAt(new \DateTime('now'));
            $updateData  = $event->getUpdateData();

            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            $vehicle = $this->getVehicleHydrator()->hydrate($updateData, $vehicleEntity);

            $entityResult = $this->getVehicleMapper()->save($vehicle);
            $event->setVehicleEntity($entityResult);
        } catch (\Exception $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function deleteVehicle(VehicleEvent $event)
    {
        try {
            $deletedData = $event->getUpdateData();
            $result = $this ->getVehicleMapper()->delete($deletedData);
        } catch (\Exception $e) {
            $this->logger->log(
                \Psr\Log\LogLevel::ERROR, 
                "{function} : Something Error! \nError_message: ".$e->getMessage(), 
                ["function" => __FUNCTION__]
            );
        }
    }

    /**
     * Get the value of vehicleHydrator
     */
    public function getVehicleHydrator()
    {
        return $this->vehicleHydrator;
    }

    /**
     * Set the value of vehicleHydrator
     *
     * @return  self
     */
    public function setVehicleHydrator($vehicleHydrator)
    {
        $this->vehicleHydrator = $vehicleHydrator;

        return $this;
    }
}
