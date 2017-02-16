<?php
/**
 * Copyright © 2015 Commershop . All rights reserved.
 */
namespace Commershop\TwoFactor\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{


	protected $_autoloaderRegistered;
    protected $_bitpay;
    protected $_sin;
    protected $_publicKey;
    protected $_privateKey;
    protected $_keyManager;
    protected $_client;
    protected $_bitpayModel;
    protected $_directory_list;
    protected $logger;
    protected $config;


	/**
     * @param \Magento\Framework\App\Helper\Context $context
     */
	// public function __construct(\Magento\Framework\App\Helper\Context $context
	// ) {
	// 	parent::__construct($context);
	// }
	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		\Magento\Framework\App\Filesystem\DirectoryList $directory_list,
		\Bitpay\Core\Logger\Logger $logger,
		\Magento\Config\Model\ResourceModel\Config $config)
	{
		
		$this->_bitpayModel = $bitpayModel;
        $this->directory_list = $directory_list;
        $this->logger = $logger;
        $this->config = $config;
        parent::__construct($context);
	}





    public function registerAutoloader()
    {
        if (true === empty($this->_autoloaderRegistered)) {            
            $base = $this->directory_list->getPath('app')."/code/Commerceshop/TwoFactor/lib/";
            $autoloader_filename = $base.'way2sms-api.php';
            if (true === is_file($autoloader_filename) && true === is_readable($autoloader_filename)) {
                require_once $autoloader_filename;
                \Bitpay\Autoloader::register();
                $this->_autoloaderRegistered = true;
                $this->debugData('[INFO] In \Bitpay\Core\Helper\Data::registerAutoloader(): autoloader file was found and has been registered.');
            } else {
                $this->_autoloaderRegistered = false;
                $this->debugData('[ERROR] In \Bitpay\Core\Helper\Data::registerAutoloader(): autoloader file was not found or is not readable. Cannot continue!');
                throw new \Exception('In \Bitpay\Core\Helper\Data::registerAutoloader(): autoloader file was not found or is not readable. Cannot continue!');
            }
        }
    }


}