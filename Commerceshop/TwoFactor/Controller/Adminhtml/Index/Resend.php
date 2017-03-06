<?php
namespace Commerceshop\TwoFactor\Controller\Adminhtml\Index;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
class Resend extends \Magento\Backend\App\Action
{
    protected $_directory_list;
    protected $_responseFactory;
    protected $_scopeConfig;
    protected $_url;
    protected $_session;
    protected $_resultPageFactory;
    protected $resultRedirect;
    protected $_transportBuilder;
    protected $_storeManager;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Filesystem\DirectoryList $directory_list,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Backend\Model\Session $session,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_responseFactory = $responseFactory;
        $this->_directory_list = $directory_list;
        $this->_url = $url;
        $this->resultRedirect = $result;
        $this->_session = $session;
        $this->_storeManager = $storeManager;
        $this->_transportBuilder = $transportBuilder;
        parent::__construct($context);
    }
    
    public function execute() 
    {        
       if ($this->_session->getMyValue()) {
        
        $mobileNumber = $this->_session->getMyValue();
        $myValue = rand(111111,999999);
        $this->_session->setOtp($myValue);
        $base = $this->_directory_list->getPath('app')."/code/Commerceshop/TwoFactor/lib/";
        require_once($base.'way2sms-api.php');
        $message = "Your Verification code is : ".$myValue;
        
        if(sendWay2SMS ( '9791743783' , 'password' , $mobileNumber , $message)){   
        	
        $CustomRedirectionUrl = $this->_url->getUrl('twofactor/index/index');
        $resultRedirect = $this->resultRedirect->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($CustomRedirectionUrl);
        return $resultRedirect; 
        }
        }
        if ($this->_session->getMyEmail()) 
        {
            $email = $this->_session->getMyEmail();
            $myValue = rand(111111,999999);
            $this->_session->setOtp($myValue);
            $full_name = "Your Verification code is : ".$myValue;
           $customObject = new \Magento\Framework\DataObject();
            $templateParams = [
                'full_name' => $full_name
            ];
            $customObject->setData($templateParams);
            $this->_transportBuilder->setTemplateIdentifier(
                'login_success'
            )->setTemplateOptions(
                [
                    'area' => \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )->setTemplateVars(
                ['user' => $customObject]
            )->setFrom(
                ['email' => 'prathap.g@innoppl.com', 'name' => 'Two Factor']
            )->addTo(
                $email,
                $full_name
            );
            try {

             $transport = $this->_transportBuilder->getTransport();
             $send = $transport->sendMessage();
             $CustomRedirectionUrl = $this->_url->getUrl('twofactor/index/index');
             $resultRedirect = $this->resultRedirect->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
             $resultRedirect->setUrl($CustomRedirectionUrl);
             return $resultRedirect; 
            } 
            catch (Exception $e) {
                
                  $e->getMessage(); 
            }
        }
    }
}
