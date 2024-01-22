<!-- Templates/admin/index.php -->

<style>
    .hidden {
        display: none;
    }

    .display {
        display: table-row;
    }

    .headerVersions {
        background-color: #f1f1f1;
    }

    .lineVersions {
        background-color: #f1f1a1;
    }
</style>

<script>
    var oldId = 0;

    function switchID(id) {
        for (let i = 0; i < document.getElementsByClassName(oldId).length; i++) {
            document.getElementsByClassName(oldId)[i].classList.remove('display');
            document.getElementsByClassName(oldId)[i].classList.add('hidden');
        }

        oldId = id;

        let classToSwitch = document.getElementsByClassName(id);
        for (let i = 0; i < classToSwitch.length; i++) {
            if (classToSwitch[i].classList.contains('hidden')) {
                classToSwitch[i].classList.remove('hidden');
                classToSwitch[i].classList.add('display');
            } else {
                classToSwitch[i].classList.remove('display');
                classToSwitch[i].classList.add('hidden');
            }
        }
    }
</script>

<?php ob_start();
$pageTitle = "ADMIN | Articles" ?>

<div class="flex">
    <h1>Articles</h1>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Auteur</th>
        <th scope="col">Titre</th>
        <th scope="col">Date de création</th>
        <th scope="col">Date de modification</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($formattedArticles as $article): ?>
        <tr>
            <td><?= $article['article']->getId() ?></td>
            <td><?= $article['createdByUsername'] ?></td>
            <td><?= $article['version']->getTitle() ?></td>
            <td><?= $article['createdAt'] ?></td>
            <td><?= $article['updatedAt'] ?></td>
            <td>
                <a href="/article/delete/<?= $article['article']->getId() ?>"
                   class="btn btn-danger">Supprimer</a>
                <button type="button" class="btn btn-success"
                        onclick="switchID(<?php echo $article['article']->getId() ?>)">+
                </button>
            </td>
        </tr>
        <tr class="headerVersions hidden <?php echo $article['article']->getId() ?>">
            <td>Id Version</td>
            <td>Auteur</td>
            <td>Titre</td>
            <td>Contenue</td>
            <td>Date de modification</td>
            <td>Actions</td>
        </tr>
        <?php foreach ($article['versions'] as $version) : ?>
            <tr class="lineVersions hidden <?php echo $article['article']->getId() ?>">
                <td><?= $version->getId() ?></td>
                <td><?= $version->getUserId() ?></td>
                <td><?= $version->getTitle() ?></td>
                <td style="overflow: clip"><?= htmlspecialchars($version->getContent()) ?></td>
                <td><?= $version->getUpdatedAt() ?></td>
                <td>
                    <a href="/version/delete/<?= $version->getId() ?>"
                       class="btn btn-danger">Supprimer</a>
                    <?php
                    if ($version->getIsValid() == 0) {
                        echo '<a href="/version/validate/' . $version->getId() . '" class="btn btn-success">Valider</a>';
                    } else {
                        echo '<a href="/version/unvalidate/' . $version->getId() . '" class="btn btn-warning">Dévalider</a>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php include './App/Templates/admin/base.php'; ?>
