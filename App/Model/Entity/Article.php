<?php

namespace App\Model\Entity;

class Article
{
    private $id;
    private $createdAt;
    private $user_id;

    public function __construct($id, $createdAt, $user_id)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->$createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->$user_id = $user_id;
    }
}