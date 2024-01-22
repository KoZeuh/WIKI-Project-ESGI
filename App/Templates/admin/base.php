<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'ARTICLE' ?></title>
    <script src="https://cdn.tiny.cloud/1/cjx0ytvuzc3v0kps066x2s41lduakjfge45us4l8jm6aoyom/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>
</head>
<body>
<main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid justify-content-between">
            <a class="navbar-nav flex-row me-2 mb-1 d-flex align-items-center" href="#">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" height="50" alt="MDB Logo"
                     loading="lazy" style="margin-top: 2px;"/>
            </a>

            <ul class="navbar-nav mx-auto">
                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/articles">Liste des articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/tags">Liste des tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Liste des utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/comments">Commentaires</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center">
                <?php if ($_SESSION['user']->getRole() === 'ROLE_ADMIN'): ?>
                    <a class="btn btn-primary me-3 me-lg-1" href="/logout">Déconnexion</a>
                    <a class="btn btn-primary me-3 me-lg-1" href="/">Retour à l'accueil</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Modal Logout Confirmation -->
        <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmLogoutModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                                aria-label="Annuler"></button>
                    </div>
                    <div class="modal-body">Vous êtes sur le point de vous déconnecter, êtes-vous sûr ?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-mdb-ripple-init data-mdb-dismiss="modal">
                            Annuler
                        </button>
                        <button type="button" class="btn btn-success" data-mdb-ripple-init id="confirmLogoutBtn">
                            Confirmer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('confirmLogoutBtn').addEventListener('click', function () {
                window.location.href = '/logout'
            });
        </script>
    </nav>
    <div class="main-content d-flex justify-content-center flex-column">
        <?php echo $content; ?>
    </div>
</main>
</body>
</html>
