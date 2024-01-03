<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Articles" ?>

<h1>Articles</h1>

<?php if (isset($articlesAsObjects)): ?>
    <?php foreach ($articlesAsObjects as $article): ?>
        <?php $version = $article->getLastVersion(); ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $article->getId() ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $version->getTitle() ?></h6>
                <p class="card-text"><?= $article->getCreatedAt() ?></p>
                <p class="card-text"><?= $article->getTags() ?></p>
                <a href="/admin/articles/<?= $article->getId() ?>" class="btn btn-primary">Voir</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php include './App/Templates/admin/base.php'; ?>
