<?php

namespace App\Model\Entity;

use App\Model\Repository\UserRepository;

class Comment
{
    private $id;
    private $content;
    private $createdAt;
    private $user_id;
    private $article_id;

    private $username;

    public function __construct($id, $content, $createdAt, $user_id, $article_id)
    {
        $this->id = $id;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->user_id = $user_id;
        $this->article_id = $article_id;
        $this->username = UserRepository::getInstance()->getUsernameById($user_id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getArticle_id()
    {
        return $this->article_id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
}