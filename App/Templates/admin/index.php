<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Index"?>

<h1>Liste des Articles</h1>

<ul>
    <?php for($i = 0; $i < 10; $i++): ?>
        <li>Article <?= $i ?></li>
    <?php endfor; ?>
</ul>

<?php $content = ob_get_clean(); ?>

<?php include 'base.php'; ?>
