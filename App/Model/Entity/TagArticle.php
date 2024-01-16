<?php

namespace App\Model\Entity;

class TagArticle
{
    private $tag_id;
    private $article_id;

    public function __construct($tag_id, $article_id)
    {
        $this->tag_id = $tag_id;
        $this->article_id = $article_id;
        
    }
    /**
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    public function getArticleId()
    {
        return $this->article_id;
    }

    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;
    }
}