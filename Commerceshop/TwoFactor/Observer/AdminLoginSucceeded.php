<?php

namespace Commerceshop\TwoFactor\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class AdminLoginSucceeded implements ObserverInterface 
{
	protected $_responseFactory;
	protected $_url;
	/*protected $_authSession;*/
	public function __construct(\Magento\Framework\App\ResponseFactory $responseFactory,
		\Magento\Framework\UrlInterface $url)
	{	
		$this->_responseFactory = $responseFactory;
		$this->_url = $url;
		/*$this->_authSession = $authSession;*/
        
	}
    public function execute(Observer $observer) 
    {

    	/*$auth = $this->_authSession;
    	$auth->getUser()->getUserId();*/
    	$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/TwoFactor.log'); 
    	$logger = new \Zend\Log\Logger(); 
    	$logger->addWriter($writer); 
    	$logger->info("workz");
         //$this->redirect->redirect($controller->getResponse(), 'exampleadminnewpage/helloworld/index');
    }
}