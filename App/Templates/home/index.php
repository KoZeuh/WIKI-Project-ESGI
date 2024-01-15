<?php include_once 'App/Templates/default/navbar.php'; ?>

<div class="row justify-content-center mx-2 mt-3">
    <?php foreach ($formattedarticlesOfTheDay as $formattedArticle): ?>
        <div class="col-6">
            <div class="image-container">
                <img class="img-fluid" src="https://preview.colorlib.com/theme/philosophy/images/thumbs/featured/featured-guitarman.jpg" style="width: 100%;" alt="Image">

                <?php if (!empty($formattedArticle['article']->getTags())): ?>
                    <div class="category-background">
                        <?= implode(', ', $formattedArticle['article']->getTags()); ?>
                    </div>
                <?php endif; ?>

                <h3 class="image-title"><?= $formattedArticle['version']->getTitle() ?></h3>
                <div class="user-info">
                    <img class="avatar" src="https://preview.colorlib.com/theme/philosophy/images/avatars/user-03.jpg" alt="Avatar">
                    <span class="user-name"><?= $formattedArticle['createdByUsername'] ?></span>
                    <span class="publication-date">- <?= $formattedArticle['article']->getCreatedAt() ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="container">
    <section class="mx-auto my-5">
        <h2 class="text-center">Quelques articles du mois</h2>
        <div class="row row-cols-3 g-4">
            <?php foreach($formattedArticlesOfTheMonth as $formattedArticle): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-row">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" class="rounded-circle me-3"
                                height="50px" width="50px" alt="avatar"/>
                            <div>
                                <h5 class="card-title font-weight-bold mb-2"><?= $formattedArticle['version']->getTitle() ?></h5>
                                <p class="card-text"><i class="far fa-clock pe-2"></i><?= $formattedArticle['article']->getCreatedAt() ?></p>
                            </div>
                        </div>
                        <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<div class="container d-flex justify-content-center">
    <ul class="pagination pagination-circle">
        <li class="page-item">
            <a class="page-link">Previous</a>
        </li>

        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">1<span class="visually-hidden">(current)</span></a>
        </li>

        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>

        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>

        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>

<?php include_once 'App/Templates/default/footer.php'; ?>