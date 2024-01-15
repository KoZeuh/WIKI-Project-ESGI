<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'WIKI ESGI' ?></title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="App/Templates/default/assets/css/style.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <div class="d-flex input-group w-auto my-auto">
            <button class="input-group-text border-0">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <a class="navbar-nav flex-row me-2 mb-1 d-flex align-items-center" href="#">
            <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="20" alt="MDB Logo" loading="lazy" style="margin-top: 2px;"/>
        </a>

        <?php if (empty($_SESSION['user'])): ?>
            <div class="d-flex align-items-center">
                <a class="btn btn-primary me-3 me-lg-1" href="/login">Connexion</a>
                <a class="btn btn-primary me-3 me-lg-1" href="/register">Inscription</a>
            </div>
        <?php else: ?>
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
        <?php endif; ?>
    </div>
</nav>


