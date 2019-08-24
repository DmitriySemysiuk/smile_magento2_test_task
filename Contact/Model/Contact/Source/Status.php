<?php

namespace SMile\Contact\Model\Contact\Source;

use Magento\Framework\Data\OptionSourceInterface;
use SMile\Contact\Model\Contact;

/**
 * Class Status
 *
 * @package SMile\Contact\Model\Contact\Source
 */
class Status implements OptionSourceInterface
{
    /**
     * Contact
     *
     * @var Contact
     */
    private $contact;

    /**
     * Status constructor
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->contact->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
