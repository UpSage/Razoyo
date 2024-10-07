<?php

namespace Razoyo\CarProfile\Block;

use Magento\Framework\View\Element\Template;
use Razoyo\CarProfile\Model\CarProfileFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Pricing\Helper\Data as PricingHelper;

class Form extends Template
{
    protected $carProfileFactory;
    protected $customerSession;
    protected $pricingHelper;

    public function __construct(
        Template\Context $context,
        CarProfileFactory $carProfileFactory,
        CustomerSession $customerSession,
        PricingHelper $pricingHelper, // Injecting the PricingHelper
        array $data = []
    ) {
        $this->carProfileFactory = $carProfileFactory;
        $this->customerSession = $customerSession;
        $this->pricingHelper = $pricingHelper;
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


    public function formatPrice($amount)
    {
        return $this->pricingHelper->currency($amount, true, false);
    }
}
