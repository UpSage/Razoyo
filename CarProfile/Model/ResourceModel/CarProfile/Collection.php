<?php

namespace Razoyo\CarProfile\Model\ResourceModel\CarProfile;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Razoyo\CarProfile\Model\CarProfile as Model;
use Razoyo\CarProfile\Model\ResourceModel\CarProfile as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
