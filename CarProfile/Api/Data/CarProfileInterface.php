<?php

namespace Razoyo\CarProfile\Api\Data;

/**
 * Interface CarProfileInterface
 * @package Razoyo\CarProfile\Api\Data
 */
interface CarProfileInterface
{
    /**
     * Get customer ID.
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set customer ID.
     *
     * @param int $customerId
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get car make.
     *
     * @return string
     */
    public function getCarMake();

    /**
     * Set car make.
     *
     * @param string $carMake
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarMake($carMake);

    /**
     * Get car model.
     *
     * @return string
     */
    public function getCarModel();

    /**
     * Set car model.
     *
     * @param string $carModel
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarModel($carModel);

    /**
     * Get created at date.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created at date.
     *
     * @param string $createdAt
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCreatedAt($createdAt);
}
