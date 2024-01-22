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


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-black bg-dark-subtle">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img src="https://logos-marques.com/wp-content/uploads/2020/04/Petit-Bateau-logo.png" height="50"/>
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link text-light" href="/">Accueil</a>
            </li>
        <?php if (!empty($_SESSION['user'])): ?>
            <li class="nav-item">
                <a class="nav-link text-light" href="/article/list">Liste des articles</a>
            </li>
        <?php endif; ?>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <?php if (empty($_SESSION['user'])): ?>
        <a class="btn btn-primary me-3 me-lg-1" href="/login">Connexion</a>
        <a class="btn btn-success me-3 me-lg-1" href="/register">Inscription</a>
      <?php else: ?>
        <!-- Avatar -->
        <div class="dropdown">
          <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25"/>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
            <?php if ($_SESSION['user']->getRole() === 'ROLE_ADMIN'): ?>
              <a class="dropdown-item" href="/admin">Administration</a>
            <?php endif; ?>
            <li>
              <a class="dropdown-item" href="/compte">Profil</a>
            </li>
            <li>
              <a class="dropdown-item" href="/logout" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#confirmLogoutModal">Se déconnecter</a>
            </li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>

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
<!-- Navbar -->