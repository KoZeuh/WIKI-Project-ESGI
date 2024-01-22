<?php

namespace App\Model\Entity;

class Comment
{
    private $id;
    private $content;
    private $createdAt;
    private $user_id;
    private $article_id;

    public function __construct($id, $content, $createdAt, $user_id, $article_id)
    {
        $this->id = $id;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->user_id = $user_id;
        $this->article_id = $article_id;
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

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getArticleId()
    {
        return $this->article_id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
}