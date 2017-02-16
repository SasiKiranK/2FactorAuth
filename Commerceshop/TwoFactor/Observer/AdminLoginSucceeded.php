<?php

namespace Commerceshop\TwoFactor\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class AdminLoginSucceeded implements ObserverInterface 
{
	protected $_responseFactory;
	protected $_url;
	protected $_authSession;
	protected $_session;
	public function __construct(\Magento\Framework\App\ResponseFactory $responseFactory,
		\Magento\Backend\Model\Auth\Session $authSession,
		\Magento\Framework\UrlInterface $url,
		\Magento\Backend\Model\Session $session)
	{	
		$this->_responseFactory = $responseFactory;
		$this->_url = $url;
		$this->_authSession = $authSession;
		$this->_session = $session;
        
	}
    public function execute(Observer $observer) 
    {

    	$auth = $this->_authSession;
    	$auth->getUser()->getUserId();
    	$this->_session->setIsloggedin(1);
    	$this->_session->setOtpdone(0);

        $myValue = rand(111111,999999);
    	$this->_session->setOtp($myValue);
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