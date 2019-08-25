<?php

namespace SMile\Contact\Controller\Adminhtml\ContactRequest;

use Magento\Backend\App\Action;

class Save extends Action
{
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/');

        return $resultRedirect;
    }
}
