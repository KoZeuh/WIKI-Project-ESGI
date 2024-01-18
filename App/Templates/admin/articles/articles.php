<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Articles" ?>

<div class="flex">
    <h1>Articles</h1>
</div>
<table class="table table-striped">
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
        <!--Faire en sorte que le content ne sois pas interprété par le site et que les balises ne s'affichent pas-->
        <tr>
            <td><?= $article['article']->getId() ?></td>
            <td><?= $article['createdByUsername'] ?></td>
            <td><?= $article['version']->getTitle() ?></td>
            <td><?= $article['createdAt'] ?></td>
            <td><?= $article['updatedAt'] ?></td>
            <td>
                <a href="/admin/show/<?= $article['article']->getId() ?>" class="btn btn-primary">Afficher</a>
                <a href="/admin/articles/delete/<?= $article['article']->getId() ?>"
                   class="btn btn-danger">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php include './App/Templates/admin/base.php'; ?>
