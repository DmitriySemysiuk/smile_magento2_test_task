<?php

namespace SMile\Contact\Controller\Adminhtml\ContactRequest;

use Magento\Backend\App\Action;
use SMile\Contact\Api\ContactRepositoryInterface;

/**
 * Class Delete
 *
 * @package SMile\Contact\Controller\Adminhtml\ContactRequest
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'SMile_Contact::contact_delete';

    /**
     * Contact repository interface
     *
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * Delete constructor
     *
     * @param Action\Context              $context
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Action\Context              $context,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $contactRepository = $this->contactRepository;
                $contactRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The contact request has been deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/delete', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a contact request to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
