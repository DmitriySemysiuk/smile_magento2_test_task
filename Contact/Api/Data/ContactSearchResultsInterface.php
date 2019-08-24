<?php

namespace SMile\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ContactSearchResultsInterface
 *
 * @package SMile\Contact\Api\Data
 */
interface ContactSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get contact list
     *
     * @return \SMile\Catalog\Api\Data\ContactInterface[]
     */
    public function getItems();

    /**
     * Set contact list
     *
     * @param \SMile\Contact\Api\Data\ContactInterface[] $items
     *
     * @return PostSearchResultsInterface
     */
    public function setItems(array $items);
}
