<?php
namespace Vehicle\V1\Rest\Vehicle;

use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Paginator\Paginator as ZendPaginator;
use Vehicle\Mapper\Vehicle as VehicleMapper;
use Vehicle\Mapper\VehicleTrait as VehicleMapperTrait;
use ZF\Rest\AbstractResourceListener;

class VehicleResource extends AbstractResourceListener
{
    use VehicleMapperTrait;

    protected $vehicleService;

    public function __construct(
        VehicleMapper $vehicleMapper
    ) {
        $this->setVehicleMapper($vehicleMapper);
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data = (array) $data;
        $now = new \DateTime('now');
        $inputFilter = $this->getInputFilter();

        try {
            $inputFilter->add(['name' => 'createdAt']);
            $inputFilter->get('createdAt')->setValue($now);

            $inputFilter->add(['name' => 'updatedAt']);
            $inputFilter->get('updatedAt')->setValue($now);

            $result = $this->getVehicleService()->save($inputFilter);
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }
        return $result;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        try {
            $vehicle = $this->getVehicleMapper()->fetchOneBy(['uuid' => $id]);
            if (is_null($vehicle)) {
                return new ApiProblem(404, "Data pelanggan tidak ditemukan");
            }

            return $this->getVehicleService()->delete($vehicle);
        } catch (\RuntimeException $e) {
            return new ApiProblemResponse(new ApiProblem(500, $e->getMessage()));
        }

        return $vehicle;
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $queryParams = [
            'uuid' => $id,
        ];

        $vehicle = $this->getVehicleMapper()->fetchOneBy($queryParams);
        if (is_null($vehicle)) {
            return new ApiProblemResponse(new ApiProblem(404, "Data kendaraan tidak ditemukan"));
        }

        return $vehicle;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $queryParams =  $params->toArray();

        $order = null;
        $asc = false;

        if (isset($queryParams['order'])) {
            $order = $queryParams['order'];
            unset($queryParams['order']);
        }

        if (isset($queryParams['ascending'])) {
            $asc = $queryParams['ascending'];
            unset($queryParams['ascending']);
        }
        $qb = $this->getVehicleMapper()->fetchAll($queryParams, $order, $asc);
        $paginatorAdapter = $this->getVehicleMapper()->createPaginatorAdapter($qb);
        return new ZendPaginator($paginatorAdapter);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        $vehicle = $this->getVehicleMapper()->fetchOneBy(['uuid' => $id]);
        if (is_null($vehicle)) {
            return new ApiProblemResponse(new ApiProblem(404, "Data tidak ditemukan!"));
        }
        $inputFilter = $this->getInputFilter();

        $this->getVehicleService()->update($vehicle, $inputFilter);
        return $vehicle;
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }

    /**
     * Get the value of vehicleService
     */ 
    public function getVehicleService()
    {
        return $this->vehicleService;
    }

    /**
     * Set the value of vehicleService
     *
     * @return  self
     */ 
    public function setVehicleService($vehicleService)
    {
        $this->vehicleService = $vehicleService;

        return $this;
    }
}
