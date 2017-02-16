<?php

namespace Commerceshop\TwoFactor\Controller\Adminhtml\Index;


class Verify extends \Magento\Backend\App\Action
{
    public function execute()
    {
    	echo "string";
exit();
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
	}
}

?>