<?php

namespace Razoyo\CarProfile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CarProfile extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('razoyo_car_profile', 'entity_id');
    }
}
