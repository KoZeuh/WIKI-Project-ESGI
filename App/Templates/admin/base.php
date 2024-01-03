<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'ADMIN' ?></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<style>
    .navbar-primary {
        background-color: #333;
        bottom: 0;
        left: 0;
        position: absolute;
        top: 0;
        width: 200px;
        z-index: 8;
        overflow: hidden;
        -webkit-transition: all 0.1s ease-in-out;
        -moz-transition: all 0.1s ease-in-out;
        transition: all 0.1s ease-in-out;
    }

    .navbar-primary.collapsed {
        width: 60px;
    }

    .navbar-primary.collapsed .glyphicon {
        font-size: 22px;
    }

    .navbar-primary.collapsed .nav-label, .navbar-primary.collapsed .deco {
        display: none;
    }

    .btn-expand-collapse {
        position: absolute;
        display: block;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 8px 0;
        border-top: solid 1px #666;
        color: grey;
        font-size: 20px;
        text-align: center;
    }

    .btn-disconnect-collapse {
        position: absolute;
        display: block;
        left: 0;
        bottom: 50px;
        width: 100%;
        padding: 8px 0;
        border-top: solid 1px #666;
        color: grey;
        font-size: 20px;
        text-align: center;
    }

    .btn-expand-collapse:hover,
    .btn-expand-collapse:focus,
    .btn-disconnect-collapse:hover,
    .btn-disconnect-collapse:focus {
        background-color: #222;
        color: white;
    }

    .btn-expand-collapse:active,
    .btn-disconnect-collapse:active {
        background-color: #111;
    }

    .navbar-primary-menu,
    .navbar-primary-menu li {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .navbar-primary-menu li a {
        display: block;
        padding: 10px 18px;
        text-align: left;
        border-bottom: solid 1px #444;
        color: #ccc;
    }

    .navbar-primary-menu li a:hover {
        background-color: #000;
        text-decoration: none;
        color: white;
    }

    .navbar-primary-menu li a .fa, .navbar-primary a .fa {
        margin-right: 6px;
    }

    .navbar-primary-menu li a:hover .fa, navbar-primary .fa {
        color: orchid;
    }

    .navbar-primary-menu a, .navbar-primary a {
        text-decoration: none;
    }

    .selected {
        background-color: #000;
        text-decoration: none;
        color: white;
    }

    .main-content {
        margin-left: 200px;
        padding: 20px;
    }

    .collapsed + .main-content {
        margin-left: 60px;
    }
</style>
<?php
$uri = $_SERVER['REQUEST_URI'];
?>
<main>
    <nav class="navbar-primary">
        <a href="#" class="btn-disconnect-collapse"><i class="fa-solid fa-right-from-bracket fa"></i><span class="deco">Déconnexion</span></a>
        <a href="#" class="btn-expand-collapse"><i class="fa-solid fa-arrow-left"></i></a>
        <ul class="navbar-primary-menu">
            <li>
                <a href="/admin" class="<?php if ($uri == '/admin') echo "selected"; ?>"><i
                            class="fa-solid fa-list fa"></i><span class="nav-label">Index</span></a>
                <a href="/admin/articles" class="<?php if ($uri == '/admin/articles') echo "selected"; ?>"><i
                            class="fa-solid fa-newspaper fa"></i><span class="nav-label">Articles</span></a>
                <a href="/admin/comments" class="<?php if ($uri == '/admin/comments') echo "selected"; ?>"><i
                            class="fa-solid fa-comments fa"></i><span class="nav-label">Commentaires</span></a>
                <a href="/admin/users" class="<?php if ($uri == '/admin/users') echo "selected"; ?>"><i
                            class="fa-solid fa-users fa"></i><span class="nav-label">Utilisateurs</span></a>
                <a href="/admin/settings" class="<?php if ($uri == '/admin/settings') echo "selected"; ?>"><i
                            class="fa-solid fa-gear fa"></i><span class="nav-label">Paramètres</span></a>
            </li>
        </ul>
    </nav>
    <div class="main-content">
        <?php echo $content; ?>
    </div>
</main>
<script>
    $('.btn-expand-collapse').click(function (e) {
        $('.navbar-primary').toggleClass('collapsed');
    });
</script>
</body>
</html>
