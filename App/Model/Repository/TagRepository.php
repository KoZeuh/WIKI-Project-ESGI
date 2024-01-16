<?php

namespace App\Model\Repository;

use App\Model\Entity\Article;
use App\Model\Entity\Tag;

use App\Database\Database;
use PDO;
use PDOException;

class TagRepository
{
    private static $instance;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Empêche le clonage de l'objet
    public function __clone() {}

    // Empêche la désérialisation de l'objet
    public function __wakeup() {}

    public function getTags()
    {
        try {
            $query = $this->db->prepare('SELECT * FROM tag');
            $query->execute();
            $query = $query->fetchAll(PDO::FETCH_ASSOC);

            $tagsObjects = [];

            foreach ($query as $tag) {
                $tagsObjects[] = new Tag($tag['id'], $tag['name']);
            }

            return $tagsObjects;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}