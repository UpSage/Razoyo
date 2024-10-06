<?php

namespace Razoyo\CarProfile\Block;

use Magento\Framework\View\Element\Template;
use Razoyo\CarProfile\Model\CarProfileFactory;
use Magento\Customer\Model\Session as CustomerSession;

class Form extends Template
{
    protected $carProfileFactory;
    protected $customerSession;

    public function __construct(
        Template\Context $context,
        CarProfileFactory $carProfileFactory,
        CustomerSession $customerSession,
        array $data = []
    ) {
        $this->carProfileFactory = $carProfileFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getCarData()
    {
        $customerId = $this->customerSession->getCustomerId();
        if ($customerId) {
            $carProfile = $this->carProfileFactory->create()->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->getFirstItem();

            return $carProfile->getData();
        }
        return null;
    }
}
