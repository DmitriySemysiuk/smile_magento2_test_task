<?php

namespace SMile\Contact\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use SMile\Contact\Api\ContactRepositoryInterface;
use SMile\Contact\Api\Data;
use SMile\Contact\Model\ResourceModel\Contact as ResourceContact;
use SMile\Contact\Model\ResourceModel\Contact\CollectionFactory as ContactCollectionFactory;


class ContactRepository implements ContactRepositoryInterface
{
    /**
     * Resource Contact
     *
     * @var \SMile\Contact\Model\ResourceModel\Contact
     */
    private $resource;

    /**
     * Contact factory
     *
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * Contact collection factory
     *
     *@var \SMile\Contact\Model\ResourceModel\Contact\CollectionFactory
     */
    private $contactCollectionFactory;

    /**
     * Contact search results interface factory
     *
     * @var ContactSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * ContactRepository constructor.
     *
     * @param ResourceContact $resource
     * @param ContactFactory $contactFactory
     * @param ContactCollectionFactory $contactCollectionFactory
     * @param Data\ContactSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceContact $resource,
        ContactFactory $contactFactory,
        ContactCollectionFactory $contactCollectionFactory,
        Data\ContactSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->contactFactory = $contactFactory;
        $this->contactCollectionFactory = $contactCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Contact data
     *
     * @param \SMile\Contact\Api\Data\ContactInterface $contact
     *
     * @return Contact
     *
     * @throws CouldNotSaveException
     */
    public function save(Data\ContactInterface $contact)
    {
        try {
            $this->resource->save($contact);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $contact;
    }

    /**
     * Load contact data by given contact Identity
     *
     * @param string $contactId
     *
     * @return Contact
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($contactId)
    {
        $contact = $this->priceRequestFactory->create();
        $this->resource->load($contact, $contactId);
        if (!$contact->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $contactId));
        }

        return $contact;
    }

    /**
     * Load Contact data collection by given search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     *
     * @return \SMile\Contact\Model\ResourceModel\Contact\Collection
     */
    public function getList(SearchCriteriaInterface $criteria = null)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->contactCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $contact = [];
        /** @var Data\PriceRequestInterface $priceRequestModel */
        foreach ($collection as $contactModel) {
            $contact[] = $contactModel;
        }
        $searchResults->setItems($contact);

        return $searchResults;
    }

    /**
     * Delete Contact
     *
     * @param \SMile\Contact\Api\Data\ContactInterface $contact
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     */
    public function delete(Data\ContactInterface $contact)
    {
        try {
            $this->resource->delete($contact);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Contact by given Contact Identity
     *
     * @param string $contactId
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($contactId)
    {
        return $this->delete($this->getById($contactId));
    }
}
