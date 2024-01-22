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
        <img src="data:image/jpeg;base64,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" height="50"/>
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
            <img src="https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png" class="rounded-circle" height="25"/>
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