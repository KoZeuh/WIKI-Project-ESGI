<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Index" ?>

<h1>Index</h1>

<?php $content = ob_get_clean(); ?>

<?php include 'base.php'; ?>
