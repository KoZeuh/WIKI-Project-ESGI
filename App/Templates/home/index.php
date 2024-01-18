<?php include_once 'App/Templates/default/navbar.php'; ?>

    <div class="row justify-content-center mx-2 mt-3">
        <?php foreach ($formattedArticlesOfTheDay as $formattedArticle): ?>
            <div class="col-6">
                <a href="/article/show/<?= $formattedArticle['article']->getId() ?>">
                    <div class="image-container">
                        <img class="img-fluid"
                             src="https://preview.colorlib.com/theme/philosophy/images/thumbs/featured/featured-guitarman.jpg"
                             style="width: 100%;" alt="Image">

                        <?php if ($formattedArticle['tags']): ?>
                            <div class="category-background">
                                <?php foreach ($formattedArticle['tags'] as $tag): ?>
                                    <span class="category"><?= $tag->getName() ?>, </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="image-title"><?= $formattedArticle['version']->getTitle() ?></h3>
                        <div class="user-info">
                            <img class="avatar"
                                 src="https://preview.colorlib.com/theme/philosophy/images/avatars/user-03.jpg"
                                 alt="Avatar">
                            <span class="user-name"><?= $formattedArticle['createdByUsername'] ?></span>
                            <span class="publication-date"><?= $formattedArticle['createdAt'] ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="container">
        <section class="mx-auto my-5">
            <h2 class="text-center">Quelques articles du mois</h2>
            <div class="row row-cols-3 g-4">
                <?php foreach ($formattedArticlesOfTheMonth as $formattedArticle): ?>
                    <div class="col-md-4">
                        <a href="/article/show/<?= $formattedArticle['article']->getId() ?>">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-row">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg"
                                         class="rounded-circle me-3"
                                         height="50px" width="50px" alt="avatar"/>
                                    <div>
                                        <h5 class="card-title font-weight-bold mb-2"><?= $formattedArticle['version']->getTitle() ?></h5>
                                        <p class="card-text"><i
                                                    class="far fa-clock pe-2"></i><?= $formattedArticle['createdAt'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

<?php include_once 'App/Templates/default/footer.php'; ?>