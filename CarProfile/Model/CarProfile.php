<?php

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Model\AbstractModel;
use Razoyo\CarProfile\Api\Data\CarProfileInterface;

class CarProfile extends AbstractModel implements CarProfileInterface
{
    protected function _construct()
    {
        $this->_init(\Razoyo\CarProfile\Model\ResourceModel\CarProfile::class);
    }

    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
    }

    public function getCarMake()
    {
        return $this->getData('car_make');
    }

    public function setCarMake($carMake)
    {
        return $this->setData('car_make', $carMake);
    }

    public function getCarModel()
    {
        return $this->getData('car_model');
    }

    public function setCarModel($carModel)
    {
        return $this->setData('car_model', $carModel);
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData('created_at', $createdAt);
    }

    public function getCarId()
    {
        return $this->getData('car_id');
    }

    public function setCarId($carId)
    {
        return $this->setData('car_id', $carId);
    }

    public function getCarMpg()
    {
        return $this->getData('car_mpg');
    }

    public function setCarMpg($carMpg)
    {
        return $this->setData('car_mpg', $carMpg);
    }

    public function getCarPrice()
    {
        return $this->getData('car_price');
    }

    public function setCarPrice($carPrice)
    {
        return $this->setData('car_price', $carPrice);
    }

    public function getCarSeats()
    {
        return $this->getData('car_seats');
    }

    public function setCarSeats($carSeats)
    {
        return $this->setData('car_seats', $carSeats);
    }

    public function getCarYear()
    {
        return $this->getData('car_year');
    }

    public function setCarYear($carYear)
    {
        return $this->setData('car_year', $carYear);
    }

    public function getCarImage()
    {
        return $this->getData('car_image');
    }

    public function setCarImage($carImage)
    {
        return $this->setData('car_image', $carImage);
    }
}
