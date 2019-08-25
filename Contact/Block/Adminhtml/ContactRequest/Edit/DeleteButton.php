<?php

namespace SMile\Contact\Block\Adminhtml\ContactRequest\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 *
 * @package SMile\Contact\Block\Adminhtml\ContactRequest\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Url path
     */
    const DELETE_CONFIRM_URL = '*/*/delete';

    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getContactId()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 40,
            ];
        }

        return $data;
    }

    /**
     * Get URL FOR delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl(self::DELETE_CONFIRM_URL, ['id' => $this->getContactId()]);
    }
}
