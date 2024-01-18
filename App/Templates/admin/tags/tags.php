<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Tags" ?>

<div class="flex">
    <h1>Tags</h1>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nom</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tags as $tag): ?>
        <tr>
            <form action="/tag/edit/<?= $tag->getId() ?>" method="post">
                <td><?= $tag->getId() ?></td>
                <td><input type="text" name="name" id="name" value="<?= $tag->getName() ?>"></td>
                <td>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <a href="/tag/delete/<?= $tag->getId() ?>"
                       class="btn btn-danger">Supprimer</a>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php include './App/Templates/admin/base.php'; ?>
<?php
