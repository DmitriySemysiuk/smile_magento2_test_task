<?php

namespace SMile\Contact\Controller\Adminhtml\ContactRequest;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package SMile\Contact\Controller\Adminhtml\Contact
 */
class Index extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'SMile_Contact::ContactRequests';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SMile_Contact::ContactRequests');
        $resultPage->addBreadcrumb(__('Contact_Us Requests'), __('Contact_Us Requests'));
        $resultPage->addBreadcrumb(__('Contact_Us Requests'), __('Contact_Us Requests'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contact_Us requests'));

        return $resultPage;
    }
}
