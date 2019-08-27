<?php

namespace SMile\Contact\Plugin\Controller\Index\Post;

use Magento\Contact\Controller\Index\Post as CustomerContact;
use SMile\Contact\Api\ContactRepositoryInterface;
use SMile\Contact\Model\ContactFactory;
use \Psr\Log\LoggerInterface;


class AfterPostExecute
{
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
     * Log
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AfterPostExecute constructor.
     *
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactFactory $contactFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ContactRepositoryInterface $contactRepository,
        ContactFactory $contactFactory,
        LoggerInterface $logger
    ) {
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
        $this->logger = $logger;
    }

    public function afterExecute(CustomerContact $subject, $result)
    {
        $data = $subject->getRequest()->getPostValue();
        if ($data) {
            try{
            $model = $this->contactFactory->create();
            $model->setData($data);

            $this->contactRepository->save($model);
            } catch (\Exception $e) {
                $this->logger->critical('Error while save CONTACT_US data to DB', ['exception' => $e]);
            }
        }

        return $result;
    }
}
