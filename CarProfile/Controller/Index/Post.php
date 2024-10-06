<?php

namespace Razoyo\CarProfile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Razoyo\CarProfile\Model\CarProfileFactory;

class Post extends Action
{
    protected $jsonFactory;
    protected $customerSession;
    protected $carProfileFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CustomerSession $customerSession,
        CarProfileFactory $carProfileFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->customerSession = $customerSession;
        $this->carProfileFactory = $carProfileFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            if (empty($postData['car_make']) || empty($postData['car_model'])) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => __('Car make and Car model are required fields.')
                ]);
            }

            try {
                $customerId = $this->customerSession->getCustomerId();

                if (!$customerId) {
                    return $resultJson->setData([
                        'success' => false,
                        'message' => __('Unable to find customer.')
                    ]);
                }

                $carProfile = $this->carProfileFactory->create();
                $carProfile->load($customerId, 'customer_id');

                if (!$carProfile->getId()) {
                    $carProfile->setData([
                        'customer_id' => $customerId,
                        'car_make' => $postData['car_make'],
                        'car_model' => $postData['car_model'],
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $carProfile->setCarMake($postData['car_make']);
                    $carProfile->setCarModel($postData['car_model']);
                    $carProfile->setCreatedAt(date('Y-m-d H:i:s'));
                }

                $carProfile->save();

                return $resultJson->setData([
                    'success' => true,
                    'message' => __('Your car profile has been submitted.'),
                    'car_make' => $postData['car_make'],
                    'car_model' => $postData['car_model']
                ]);

            } catch (\Exception $e) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => __('Unable to save your car profile: ' . $e->getMessage())
                ]);
            }
        }

        return $resultJson->setData([
            'success' => false,
            'message' => __('No data received.')
        ]);
    }
}
