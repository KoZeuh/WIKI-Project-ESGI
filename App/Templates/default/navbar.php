<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'WIKI ESGI' ?></title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="App/Templates/default/assets/css/style.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <a class="navbar-nav flex-row me-2 mb-1 d-flex align-items-center" href="#">
            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" height="50" alt="MDB Logo" loading="lazy" style="margin-top: 2px;"/>
        </a>

        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            <?php if (!empty($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/articles_list">Liste des articles</a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="d-flex align-items-center">
            <?php if (empty($_SESSION['user'])): ?>
                <a class="btn btn-primary me-3 me-lg-1" href="/login">Connexion</a>
                <a class="btn btn-success me-3 me-lg-1" href="/register">Inscription</a>
            <?php else: ?>
                <button class="btn btn-danger me-3 me-lg-1" href="/logout" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#confirmLogoutModal">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" class="rounded-circle" height="22"/>
                    <strong class="d-none d-sm-block ms-1"><?= $_SESSION['user']->getUsername() ?></strong>
                </button>

                <?php if ($_SESSION['user']->getRole() === 'ROLE_ADMIN'): ?>
                    <a class="btn btn-primary me-3 me-lg-1" href="/admin">Administration</a>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

    <!-- Modal Logout Confirmation -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Annuler"></button>
                </div>
                <div class="modal-body">Vous êtes sur le point de vous déconnecter, êtes-vous sûr ?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-mdb-ripple-init data-mdb-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" data-mdb-ripple-init id="confirmLogoutBtn">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirmLogoutBtn').addEventListener('click', function () {window.location.href = '/logout'});
    </script>
</nav>


