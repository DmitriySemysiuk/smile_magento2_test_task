<?php

namespace SMile\Contact\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use SMile\Contact\Api\Data\ContactInterface;

class Contact extends AbstractModel implements IdentityInterface, ContactInterface
{
    /**#@+
     * Contact us request statuses
     */
    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_CLOSED = 3;
    /**#@-**/

    /**
     * SMile contact us request cache tag
     */
    const CACHE_TAG = "smile_contact_request_tag";

    /**
     * Prefix of model events names
     *
     * @var string
     */
    public $eventPrefix = 'smile_contact_request_tag';

    /**
     * Comment construct
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init("SMile\Contact\Model\ResourceModel\Contact");
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve price request id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATE_AT);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return ContactInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ContactInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ContactInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return ContactInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     *
     * @return ContactInterface
     */
    public function setCreatedAt($creationTime)
    {
        return $this->setData(self::CREATE_AT, $creationTime);
    }

    /**
     * Set status
     *
     * @param int $status
     *
     * @return ContactInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return ContactInterface
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Prepare contact us request statuses
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return
            [
                self::STATUS_NEW => __('New'),
                self::STATUS_IN_PROGRESS => __('In progress'),
                self::STATUS_CLOSED => __("Closed")
            ];
    }
}
