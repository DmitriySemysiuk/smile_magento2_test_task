<?php

namespace SMile\Contact\Controller\Adminhtml\ContactRequest;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use SMile\Contact\Api\ContactRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;

/**
 * Class Edit
 *
 * @package SMile\Contact\Controller\Adminhtml\ContactRequest
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'SMile_Contact::contact_save';

    /**
     * Core registry
     *
     * @var Registry
     */
    private $coreRegistry;

    /**
     * Page factory
     *
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Contact request interface
     *
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * Edit constructor
     *
     * @param Context              $context
     * @param PageFactory                 $resultPageFactory
     * @param Registry                    $registry
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->contactRepository = $contactRepository;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    private function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SMile_Contact::contacts')
            ->addBreadcrumb(__('Contact'), __('Contact'))
            ->addBreadcrumb(__('Manage Contuct_Us Request'), __('Manage Contuct_Us Request'));

        return $resultPage;
    }

    /**
     * Edit Contact page
     *
     * @return \Magento\Backend\Model\View\Result\Page | \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact_Us Request Information'));

        if ($id) {
            try {
                $model = $this->contactRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while editing the contact response.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->coreRegistry->register('contact_response', $model);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();

        return $resultPage;
    }
}
