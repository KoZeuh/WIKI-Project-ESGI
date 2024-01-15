<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="App/Templates/home/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <div class="d-flex input-group w-auto my-auto">
            <button class="input-group-text border-0">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <a class="navbar-nav flex-row me-2 mb-1 d-flex align-items-center" href="#">
            <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="20" alt="MDB Logo"
                 loading="lazy" style="margin-top: 2px;"/>
        </a>

        <ul class="navbar-nav flex-row">
            <li class="nav-item me-3 me-lg-1">
                <a class="nav-link d-sm-flex align-items-sm-center" href="#">
                    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp" class="rounded-circle" height="22"/>
                    <strong class="d-none d-sm-block ms-1">John</strong>
                </a>
            </li>

            <li class="nav-item me-3 me-lg-1">
                <a class="nav-link" href="#">
                    <span><i class="fas fa-plus-circle fa-lg"></i></span>
                </a>
            </li>

            <li class="nav-item dropdown me-3 me-lg-1">
                <a
                        data-mdb-dropdown-init
                        class="nav-link dropdown-toggle hidden-arrow"
                        href="#"
                        id="navbarDropdownMenuLink"
                        role="button"
                        aria-expanded="false"
                >
                    <i class="fas fa-comments fa-lg"></i>

                    <span class="badge rounded-pill badge-notification bg-danger">6</span>
                </a>
                <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuLink"
                >
                    <li>
                        <a class="dropdown-item" href="#">Some news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Another news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown me-3 me-lg-1">
                <a
                        data-mdb-dropdown-init
                        class="nav-link dropdown-toggle hidden-arrow"
                        href="#"
                        id="navbarDropdownMenuLink"
                        role="button"
                        aria-expanded="false"
                >
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">12</span>
                </a>
                <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuLink"
                >
                    <li>
                        <a class="dropdown-item" href="#">Some news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Another news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown me-3 me-lg-1">
                <a
                        data-mdb-dropdown-init
                        class="nav-link dropdown-toggle hidden-arrow"
                        href="#"
                        id="navbarDropdownMenuLink"
                        role="button"
                        aria-expanded="false"
                >
                    <i class="fas fa-chevron-circle-down fa-lg"></i>
                </a>
                <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdownMenuLink"
                >
                    <li>
                        <a class="dropdown-item" href="#">Some news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Another news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <div class="navbar-collapse justify-content-center" id="navbarCenteredExample">
            <ul class="navbar-nav mb-2 mb-lg-0 flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


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
                            <img class="img-fluid"
                                src="https://mdbootstrap.com/img/Photos/Horizontal/Food/full page/2.jpg"
                                alt="Card image cap"/>
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-link link-danger p-md-1 my-1" data-mdb-toggle="collapse"
                                href="#collapseContent"
                                role="button" aria-expanded="false" aria-controls="collapseContent">Read more</a>
                                <div>
                                    <i class="fas fa-share-alt text-muted p-md-1 my-1 me-2" data-mdb-toggle="tooltip"
                                    data-mdb-placement="top" title="Share this post"></i>
                                    <i class="fas fa-heart text-muted p-md-1 my-1 me-0" data-mdb-toggle="tooltip"
                                    data-mdb-placement="top" title="I like it"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<div class="container d-flex justify-content-center">
    <ul class="pagination pagination-circle">
        <li class="page-item active">
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

<footer class="bg-primary text-white text-center text-lg-start mt-5">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Footer Content</h5>

                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                    molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                    voluptatem veniam, est atque cumque eum delectus sint!
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
</footer>


</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
</html>