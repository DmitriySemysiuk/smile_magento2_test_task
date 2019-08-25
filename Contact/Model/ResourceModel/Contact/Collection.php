<?php

namespace SMile\Contact\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package SMile\Contact\Model\ResourceModel\Contact
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('SMile\Contact\Model\Contact', 'SMile\Contact\Model\ResourceModel\Contact');
    }
}
