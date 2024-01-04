<?php

namespace App\Model\Entity;

use App\Model\Repository\VersionRepository;

class Article
{
    private $id;
    private $createdAt;
    private $tags;

    public function __construct($id, $createdAt, $tags)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->tags = $tags;
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
    public function getTags()
    {
        return explode(',', $this->tags);
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getLastVersion()
    {
        $version = new VersionRepository();
        $version = $version->getVersion($this->id);
        return new Version($version['id'], $version['title'], $version['isValid'], $version['content'], $version['updatedAt'], $version['article_id'], $version['user_id']);
    }

    public function getVersions()
    {
        $versions = new VersionRepository();
        $versions = $versions->getVersions($this->id);
        $versionsAsObjects = [];
        foreach ($versions as $version) {
            $versionsAsObjects[] = new Version($version['id'], $version['title'], $version['isValid'], $version['content'], $version['updatedAt'], $version['article_id'], $version['user_id']);
        }
        return $versionsAsObjects;
    }
}