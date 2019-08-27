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
            $answer = "";
            try {

                if (!empty($data['answer'])) {
                    $emailObject = new DataObject();
                    $emailObject->setData($data);

                    try {
                        $this->email->notify($emailObject);

                        $answer = "The letter has been send.";
                        $data['status'] = Contact::STATUS_CLOSED;
                    } catch(\Exception $e) {
                        $answer = "Something went wrong, the letter WAS NOT sent.";
                        $data['status'] = Contact::STATUS_IN_PROGRESS;
                    }
                }
                $model = $this->contactRepository->getById($data['id']);
                $model->setData($data);
                $this->contactRepository->save($model);

                $answer = $answer . "   The contact us request has been saved.";
                $this->messageManager->addSuccessMessage(__($answer));

                $this->dataPersistor->clear('contact_us_request');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($answer . "Contact us save fall!!!   %1", $e->getMessage());

                $this->dataPersistor->set('contact_us_request', $data);

                return $resultRedirect->setPath(
                    '*/*/edit',
                    ['id' => $this->getRequest()->getParam('id')]
                );
            }
        }

        return $resultRedirect;
    }
}
