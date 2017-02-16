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
    protected $_directory_list;
	public function __construct(\Magento\Framework\App\ResponseFactory $responseFactory,
		\Magento\Backend\Model\Auth\Session $authSession,
		\Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Filesystem\DirectoryList $directory_list,
		\Magento\Backend\Model\Session $session)
	{	
		$this->_responseFactory = $responseFactory;
		$this->_url = $url;
		$this->_authSession = $authSession;
		$this->_session = $session;
        $this->_directory_list = $directory_list;
        
	}
    public function execute(Observer $observer) 
    {

    	$auth = $this->_authSession;
    	$auth->getUser()->getUserId();
    	$this->_session->setIsloggedin(1);
    	$this->_session->setOtpdone(0);
        $myValue = rand(111111,999999);
    	$this->_session->setOtp($myValue);
        $base = $this->_directory_list->getPath('app')."/code/Commerceshop/TwoFactor/lib/";
        require_once($base.'way2sms-api.php');
        $message = "Your Verification code is : ".$myValue;
        $mobileNumber = '9751537453';
        if(sendWay2SMS ( '9789822842' , 'manoj' , $mobileNumber , $message)){
        }
    }
}