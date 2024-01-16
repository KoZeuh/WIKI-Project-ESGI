<?php include_once 'App/Templates/default/navbar.php'; ?>

<link rel="stylesheet" href="App/Templates/articles/assets/css/style.css">

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <article class="text-center">
                <header class="mb-4">
                    <h3 class="fw-bolder mb-1"><?= $formattedArticle['lastVersion']->getTitle() ?></h3>
                    <div class="text-muted fst-italic mb-2">Posté le <?= $formattedArticle['article']->getCreatedAt() ?> par <?= $formattedArticle['createdByUsername'] ?></div>
                    <?php foreach($formattedArticle['tags'] as $tag): ?>
                        <span class="badge bg-secondary text-decoration-none link-light"><?= htmlspecialchars($tag->getName()) ?></span>
                    <?php endforeach; ?>
                </header>

                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <section class="mb-5">
                    <?= $formattedArticle['lastVersion']->getContent() ?>
                </section>
            </article>
        </div>
    </div>
</div>

<?php include_once 'App/Templates/default/footer.php'; ?>