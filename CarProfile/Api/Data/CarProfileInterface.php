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

    /**
     * Get car ID.
     *
     * @return string
     */
    public function getCarId();

    /**
     * Set car ID.
     *
     * @param string $carId
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarId($carId);

    /**
     * Get car MPG.
     *
     * @return float
     */
    public function getCarMpg();

    /**
     * Set car MPG.
     *
     * @param float $carMpg
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarMpg($carMpg);

    /**
     * Get car price.
     *
     * @return float
     */
    public function getCarPrice();

    /**
     * Set car price.
     *
     * @param float $carPrice
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarPrice($carPrice);

    /**
     * Get car seats.
     *
     * @return int
     */
    public function getCarSeats();

    /**
     * Set car seats.
     *
     * @param int $carSeats
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarSeats($carSeats);

    /**
     * Get car year.
     *
     * @return int
     */
    public function getCarYear();

    /**
     * Set car year.
     *
     * @param int $carYear
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarYear($carYear);

    /**
     * Get car image.
     *
     * @return string
     */
    public function getCarImage();

    /**
     * Set car image.
     *
     * @param string $carImage
     * @return \Razoyo\CarProfile\Api\Data\CarProfileInterface
     */
    public function setCarImage($carImage);
}
