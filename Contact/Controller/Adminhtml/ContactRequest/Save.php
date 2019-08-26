<?php

namespace SMile\Contact\Controller\Adminhtml\ContactRequest;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use SMile\Contact\Model\ContactFactory;
use SMile\Contact\Api\ContactRepositoryInterface;
use SMile\Contact\Model\Contact;
use SMile\Contact\Helper;
use Magento\Framework\DataObject;

class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'SMile_Contact::contact_delete';

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Contact repository interface
     *
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * Contact factory
     *
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * Email helper
     *
     * @var Helper\Email
     */
    private $email;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactFactory $contactFactory
     * @param Helper\Email $email
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        ContactRepositoryInterface $contactRepository,
        ContactFactory $contactFactory,
        Helper\Email $email
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
        $this->email = $email;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/');

        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                $answer = "The price request has been saved.";

                if (!empty($data['answer'])) {
                    $emailObject = new DataObject();
                    $emailObject->setData($data);

                    $this->email->notify($emailObject);

                    $answer = $answer . " The letter has been send.";
                    $data['status'] = Contact::STATUS_CLOSED;
                }

                $model = $this->contactRepository->getById($data['id']);
                $model->setData($data);
                $this->contactRepository->save($model);

                $this->messageManager->addSuccessMessage(__($answer));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage("Contact us response fall: %1.", $e->getMessage());
            }
        }

        return $resultRedirect;
    }
}
