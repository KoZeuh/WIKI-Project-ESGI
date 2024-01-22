<?php

use App\Model\Repository\VersionRepository;

class VersionController
{
    public function delete($id)
    {
        VersionRepository::getInstance()->deleteVersion($id);
        header('Location: /admin/articles');
    }

    public function validate($id)
    {
        VersionRepository::getInstance()->validateVersion($id);
        header('Location: /admin/articles');
    }

    public function unvalidate($id)
    {
        VersionRepository::getInstance()->unvalidateVersion($id);
        header('Location: /admin/articles');
    }
}