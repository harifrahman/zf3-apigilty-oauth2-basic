<?php

namespace Vehicle\Entity;

use Aqilix\ORM\Entity\EntityInterface;

/**
 * Vehicle
 */
class Vehicle implements EntityInterface
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string|null
     */
    private $merk;

    /**
     * @var string|null
     */
    private $type;
    
    /**
     * @var string|null
     */
    private $plateNumber;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     */
    private $deletedAt;

    /**
     * Set updatedAt.
     *
     * @param \DateTime|null $updatedAt
     *
     * @return DeviceFunction
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return DeviceFunction
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Get the value of createdAt
     *
     * @return  \DateTime|null
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  \DateTime|null  $createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of merk
     *
     * @return  string|null
     */ 
    public function getMerk()
    {
        return $this->merk;
    }

    /**
     * Set the value of merk
     *
     * @param  string|null  $merk
     *
     * @return  self
     */ 
    public function setMerk($merk)
    {
        $this->merk = $merk;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  string|null
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string|null  $type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of plateNumber
     *
     * @return  string|null
     */ 
    public function getPlateNumber()
    {
        return $this->plateNumber;
    }

    /**
     * Set the value of plateNumber
     *
     * @param  string|null  $plateNumber
     *
     * @return  self
     */ 
    public function setPlateNumber($plateNumber)
    {
        $this->plateNumber = $plateNumber;

        return $this;
    }
}
