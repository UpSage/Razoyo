<?php

namespace Razoyo\CarProfile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Razoyo\CarProfile\Model\CarProfileFactory;
use Psr\Log\LoggerInterface;

class Post extends Action
{
    protected $coreSession;
    protected $customerSession;
    protected $carProfileFactory;
    protected $logger;

    public function __construct(
        Context $context,
        SessionManagerInterface $coreSession,
        CustomerSession $customerSession,
        CarProfileFactory $carProfileFactory,
        LoggerInterface $logger
    ) {
        $this->coreSession = $coreSession;
        $this->customerSession = $customerSession;
        $this->carProfileFactory = $carProfileFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            // Validation: Check if car_make and car_model are empty
            if (empty($postData['car_make']) || empty($postData['car_model'])) {
                $this->messageManager->addErrorMessage(__('Car make and Car model are required fields.'));
                return $this->_redirect('*/*/'); // Redirect back to the form
            }

            try {
                $customerId = $this->customerSession->getCustomerId();
                $this->logger->debug('Customer ID: ' . $customerId);

                if (!$customerId) {
                    $this->messageManager->addErrorMessage(__('Unable to find customer.'));
                    return $this->_redirect('*/*/');
                }

                // Load existing profile by customer ID
                $carProfile = $this->carProfileFactory->create();
                $carProfile->load($customerId, 'customer_id');

                if (!$carProfile->getId()) {
                    // If no profile exists, create a new one
                    $carProfile->setData([
                        'customer_id' => $customerId,
                        'car_make' => $postData['car_make'],
                        'car_model' => $postData['car_model'],
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $this->logger->debug('Creating new car profile for customer ID: ' . $customerId);
                } else {
                    // Update existing profile
                    $carProfile->setCarMake($postData['car_make']);
                    $carProfile->setCarModel($postData['car_model']);
                    $carProfile->setCreatedAt(date('Y-m-d H:i:s'));
                    $this->logger->debug('Updating existing car profile for customer ID: ' . $customerId);
                }

                // Save the car profile
                $carProfile->save();
                $this->messageManager->addSuccessMessage(__('Your car profile has been submitted.'));

            } catch (\Exception $e) {
                $this->logger->error('Error saving car profile for customer ID ' . $customerId . ': ' . $e->getMessage());
                $this->messageManager->addErrorMessage(__('Unable to save your car profile: ' . $e->getMessage()));
            }

            return $this->_redirect('*/*/');
        }

        $this->messageManager->addErrorMessage(__('No data received.'));
        return $this->_redirect('*/*/');
    }
}
