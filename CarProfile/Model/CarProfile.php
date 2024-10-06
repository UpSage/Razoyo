<?php

 namespace Razoyo\CarProfile\Model;
 
 use Magento\Framework\Model\AbstractModel;
 use Razoyo\CarProfile\Api\Data\CarProfileInterface;
 
 class CarProfile extends AbstractModel implements CarProfileInterface {
    
  protected function _construct() {
   $this->_init(\Razoyo\CarProfile\Model\ResourceModel\CarProfile::class);
  }
  
  public function getCustomerId() {
   return $this->getData('customer_id');
  }
  
  public function setCustomerId($customerId) {
   return $this->setData('customer_id', $customerId);
  }
  
  public function getCarMake() {
   return $this->getData('car_make');
  }
  
  public function setCarMake($carMake) {
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
}
