<?php

 namespace Razoyo\CarProfile\Controller\Index;
 
 use Magento\Framework\App\Action\Action;
 use Magento\Framework\App\Action\Context;
 use Magento\Framework\View\Result\PageFactory;
 use Magento\Customer\Model\Session as CustomerSession;
 use Magento\Framework\Controller\ResultFactory;
 
 class Index extends Action {
    
  protected $resultPageFactory;
  protected $customerSession;
  
  public function __construct(
   Context $context,
   PageFactory $resultPageFactory,
   CustomerSession $customerSession
  ) {
   $this->resultPageFactory = $resultPageFactory;
   $this->customerSession = $customerSession;
   parent::__construct($context);
  }
  
  public function execute(){
    
   if(!$this->customerSession->isLoggedIn()) {
    $this->messageManager->addErrorMessage(__('You need to be logged in to access this page.'));
    $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
    $resultRedirect->setUrl($this->_url->getUrl('customer/account/login'));
    return $resultRedirect;
   }
   
   $carData = $this->customerSession->getCarProfileData();
   $this->customerSession->unsCarProfileData();
   $resultPage = $this->resultPageFactory->create();
   $block = $resultPage->getLayout()->getBlock('carprofile.form');
   $block->setCarData($carData);
   return $resultPage;
   
  }

}
