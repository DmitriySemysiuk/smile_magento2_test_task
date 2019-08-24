<?php


namespace SMile\Contact\Api\Data;

/**
 * Interface ContactInterface
 *
 * @package SMile\Contact\Api\Data
 */
interface ContactInterface
{
    /**
     * Table name
     */
    const TABLE_NAME = 'contact_us_request';

    /**#@+
     * Constants defined for keys of data array.
     */
    const ID = 'id';
    const NAME = 'name';
    const EMAIL = 'email';
    const COMMENT = 'comment';
    const CREATE_AT = 'created_at';
    const STATUS = 'status';
    const ANSWER = 'answer';
    /**#@-*/

    /**
     * Get Id
     *
     * @return int
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment();

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer();

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return ContactInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ContactInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ContactInterface
     */
    public function setEmail($email);

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return ContactInterface
     */
    public function setComment($comment);

    /**
     * Set creation time
     *
     * @param string $creationTime
     *
     * @return ContactInterface
     */
    public function setCreatedAt($creationTime);

    /**
     * Set status
     *
     * @param int $status
     *
     * @return ContactInterface
     */
    public function setStatus($status);

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return ContactInterface
     */
    public function setAnswer($answer);
}
