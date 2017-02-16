<?php

namespace Commerceshop\TwoFactor\Block\Adminhtml\Index;

class Index extends \Magento\Backend\Block\Widget\Container
{

protected $_backendUrl;

    public function __construct(\Magento\Backend\Block\Widget\Context $context,array $data = [],
    	\Magento\Backend\Model\UrlInterface $backendUrl)
    {
    	parent::__construct($context, $data);

    	$this->_backendUrl = $backendUrl;
    }
    public function getformurl()
    {
        // $params = array('some'=>'url_parameters');

        return $url = $this->_backendUrl->getUrl("twofactor/index/verify");

    }
}