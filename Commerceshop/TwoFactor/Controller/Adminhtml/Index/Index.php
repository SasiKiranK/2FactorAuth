<?php
namespace Commerceshop\TwoFactor\Controller\Adminhtml\Index;
 
// use Magento\Framework\App\Action\Action;
// use Magento\Framework\App\Action\Context;
// use Magento\Framework\View\Result\PageFactory;
 
class Index extends \Magento\Backend\App\Action
{
    // protected $_resultPageFactory;
    // public function __construct(
    //     Context $context,
    //     PageFactory $resultPageFactory,
    // ) {
    //     $this->_resultPageFactory = $resultPageFactory;
    //     parent::__construct(
    //         $context
    //     );
    // }

        public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    
    public function execute()
    {
        echo "string";
        exit();
       // $resultPage = $this->_resultPageFactory->create();

       // $resultPage->addHandle('commerceshop_twofactor_opt'); //loads the layout of module_custom_customlayout.xml file with its name
       // return $resultPage;
    }
}