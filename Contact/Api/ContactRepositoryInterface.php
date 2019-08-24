<?php

namespace SMile\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use SMile\Contact\Api\Data\ContactInterface;

/**
 * Interface ContactRepositoryInterface
 *
 * @package SMile\Contact\Api
 */
interface ContactRepositoryInterface
{
    /**
     * Retrieve a contact request by it's id
     *
     * @param $objectId
     *
     * @return ContactRepositoryInterface
     */
    public function getById($objectId);

    /**
     * Retrieve contact request which match a specified criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Save contact request
     *
     * @param \SMile\Contact\Api\Data\ContactInterface $object
     *
     * @return ContactRepositoryInterface
     */
    public function save(ContactInterface $object);

    /**
     * Delete a contact request by its id
     *
     * @param int $objectId
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($objectId);
}
