<?php

namespace Razoyo\CarProfile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Razoyo\CarProfile\Model\CarProfileFactory;

class Post extends Action
{
    protected $customerSession;
    protected $carProfileFactory;

    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        CarProfileFactory $carProfileFactory
    ) {
        $this->customerSession = $customerSession;
        $this->carProfileFactory = $carProfileFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            if (empty($postData['car_make']) || empty($postData['car_model'])) {
                $this->messageManager->addErrorMessage(__('Car make and Car model are required fields.'));
                return $this->_redirect('*/*/');
            }

            try {
                $customerId = $this->customerSession->getCustomerId();

                if (!$customerId) {
                    $this->messageManager->addErrorMessage(__('Unable to find customer.'));
                    return $this->_redirect('*/*/');
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
                $this->messageManager->addSuccessMessage(__('Your car profile has been submitted.'));

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Unable to save your car profile: ' . $e->getMessage()));
            }

            return $this->_redirect('*/*/');
        }

        $this->messageManager->addErrorMessage(__('No data received.'));
        return $this->_redirect('*/*/');
    }
}
