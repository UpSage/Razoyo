<?php

namespace Razoyo\CarProfile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Razoyo\CarProfile\Model\CarProfileFactory;
use Magento\Store\Model\StoreManagerInterface;

class Post extends Action
{
    protected $jsonFactory;
    protected $customerSession;
    protected $carProfileFactory;
    protected $storeManager;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CustomerSession $customerSession,
        CarProfileFactory $carProfileFactory,
        StoreManagerInterface $storeManager // Inject StoreManager
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->customerSession = $customerSession;
        $this->carProfileFactory = $carProfileFactory;
        $this->storeManager = $storeManager; // Assign StoreManager
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            // Ensure car make and car model are provided
            if (empty($postData['car_make']) || empty($postData['car_model'])) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => __('Car make and Car model are required fields.')
                ]);
            }

            try {
                // Get logged-in customer ID
                $customerId = $this->customerSession->getCustomerId();

                if (!$customerId) {
                    return $resultJson->setData([
                        'success' => false,
                        'message' => __('Unable to find customer.')
                    ]);
                }

                // Verify that the form's customer_id matches the logged-in customer
                if (isset($postData['customer_id']) && $postData['customer_id'] != $customerId) {
                    return $resultJson->setData([
                        'success' => false,
                        'message' => __('You are not allowed to submit this form.')
                    ]);
                }

                $carProfile = $this->carProfileFactory->create();
                $carProfile->load($customerId, 'customer_id');

                if (!$carProfile->getId()) {
                    // Create a new car profile if none exists
                    $carProfile->setData([
                        'customer_id' => $customerId,
                        'car_make' => $postData['car_make'],
                        'car_model' => $postData['car_model'],
                        'car_id' => $postData['car_id'],
                        'car_mpg' => $postData['car_mpg'],
                        'car_price' => $postData['car_price'],
                        'car_seats' => $postData['car_seats'],
                        'car_year' => $postData['car_year'],
                        'car_image' => $postData['car_image'],
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    // Update existing car profile
                    $carProfile->setCarMake($postData['car_make']);
                    $carProfile->setCarModel($postData['car_model']);
                    $carProfile->setCarId($postData['car_id']);
                    $carProfile->setCarMpg($postData['car_mpg']);
                    $carProfile->setCarPrice($postData['car_price']);
                    $carProfile->setCarSeats($postData['car_seats']);
                    $carProfile->setCarYear($postData['car_year']);
                    $carProfile->setCarImage($postData['car_image']);
                    $carProfile->setCreatedAt(date('Y-m-d H:i:s'));
                }

                // Save car profile
                $carProfile->save();

                // Get the currency symbol
                $currencySymbol = $this->storeManager->getStore()->getCurrentCurrency()->getCurrencySymbol();

                // Format the price with commas and the currency symbol
                $formattedPrice = $currencySymbol . number_format($postData['car_price'], 2); // Format with 2 decimal places

                return $resultJson->setData([
                    'success' => true,
                    'message' => __('Your car profile has been submitted.'),
                    'car_make' => $postData['car_make'],
                    'car_model' => $postData['car_model'],
                    'car_id' => $postData['car_id'],
                    'car_mpg' => $postData['car_mpg'],
                    'car_price' => $formattedPrice, // Return formatted price with currency
                    'car_seats' => $postData['car_seats'],
                    'car_year' => $postData['car_year'],
                    'car_image' => $postData['car_image']
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
