<?php

namespace SMile\Contact\Block\Adminhtml\ContactRequest\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use SMile\Contact\Api\ContactRepositoryInterface;

/**
 * Class GenericButton
 *
 * @package SMile\Contact\Block\Adminhtml\ContactRequest\Edit
 */
class GenericButton
{
    /**
     * Context
     *
     * @var Context
     */
    private $context;

    /**
     * Contact repository interface
     *
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * GenericButton constructor
     *
     * @param Context                     $context
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Context $context,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->context = $context;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Get Contact ID
     *
     * @return int
     */
    public function getContactId()
    {
        try {
            $modelId = $this->context->getRequest()->getParam('id');

            return $this->contactRepository->getById($modelId)->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array  $params
     *
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
