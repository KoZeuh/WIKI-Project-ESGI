<!-- Templates/admin/index.php -->

<?php ob_start();
$pageTitle = "ADMIN | Index" ?>

<h1>Index</h1>
<h2>Nombre d'articles : <?php echo $nbArticles ?></h2>
<h2>Nombre de version : <?php echo $nbVersions ?></h2>
<h2>Nombre de tags : <?php echo $nbTags ?></h2>
<h2>Nombre d'utilisateurs : <?php echo $nbUsers ?></h2>
<!--<h2>Nombre de commentaires : --><?php //echo $nbComments ?><!--</h2>-->


<?php $content = ob_get_clean(); ?>

<?php include 'App/Templates/admin/base.php'; ?>
