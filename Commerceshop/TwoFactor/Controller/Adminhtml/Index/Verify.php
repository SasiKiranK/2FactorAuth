<?php

namespace Commerceshop\TwoFactor\Controller\Adminhtml\Index;


class Verify extends \Magento\Backend\App\Action
{
		protected $_session;
		protected $_url;
		protected $_responseFactory;
        public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Backend\Model\Session $session
    ) {
         $this->_session = $session;
         $this->_url = $url;
		$this->_responseFactory = $responseFactory;
        parent::__construct($context);
    }

    public function execute()
    {

	$otp = $this->getRequest()->getParam('OTP');
	if ($otp == $this->_session->getOtp()) {
	$this->_session->setOtpdone(1);
 	$CustomRedirectionUrl = $this->_url->getUrl('admin/dashboard/index');
	 $this->_responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();
	 exit();
}
else{
	 $this->_session->setOtpmessage("Invalid OTP, Please try again.");
             $CustomRedirectionUrl = $this->_url->getUrl('twofactor/index/index');
             $this->_responseFactory->create()->setRedirect($CustomRedirectionUrl)->sendResponse();
             exit();
}
	}
}

?>