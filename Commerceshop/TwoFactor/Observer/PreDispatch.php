<?php

namespace Commerceshop\TwoFactor\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class PreDispatch implements ObserverInterface 
{
	protected $_responseFactory;
	protected $_url;
    protected $_session;

	
	public function __construct(\Magento\Framework\App\ResponseFactory $responseFactory,
		\Magento\Framework\UrlInterface $url,
        \Magento\Backend\Model\Session $session
		)
	{	
		$this->_responseFactory = $responseFactory;
		$this->_url = $url;
        $this->_session = $session;

        
	}
    public function execute(Observer $observer) 
    {
        /*$displayText = $observer->getData('display');
        $displayText->setDisplay('Catch magento 2 event successfully!!!');*/
        // echo $this->_session->getIsloggedin();
        // echo $this->_session->getOtpdone();
        // echo $this->_session->getOtp();

    	// echo "strinssg"; exit();
    	// echo $this->_session->getSasi();

    	// $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/TwoFactor.log'); 
    	// $logger = new \Zend\Log\Logger(); 
    	// $logger->addWriter($writer); 
    	// $logger->info($auth);
    	// echo $auth->getUser()->getUserId();
    	// exit();
         //$this->redirect->redirect($controller->getResponse(), 'exampleadminnewpage/helloworld/index');
    }


    
}