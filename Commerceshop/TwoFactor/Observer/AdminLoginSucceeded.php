<?php
namespace Commerceshop\TwoFactor\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
class AdminLoginSucceeded implements ObserverInterface 
{
    protected $_responseFactory;
    protected $_url;
    protected $_authSession;
    protected $_session;
    protected $_directory_list;
    protected $_scopeConfig;
    protected $_transportBuilder;
    protected $_storeManager;
    public function __construct(\Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Filesystem\DirectoryList $directory_list,
        \Magento\Backend\Model\Session $session,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager)
    {   
        $this->_scopeConfig = $scopeConfig;
        $this->_responseFactory = $responseFactory;
        $this->_url = $url;
        $this->_authSession = $authSession;
        $this->_session = $session;
        $this->_directory_list = $directory_list;
        $this->_storeManager = $storeManager;
        $this->_transportBuilder = $transportBuilder;
        
    }
    public function execute(Observer $observer) 
    {
        $check = $this->_scopeConfig->getValue(
            'authentication/parameters/config',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($check == 'enable') 
        {

        $auth = $this->_authSession;
        $auth->getUser()->getUserId();
        $this->_session->setIsloggedin(1);
        $this->_session->setOtpdone(0);
        }
    
    }
}