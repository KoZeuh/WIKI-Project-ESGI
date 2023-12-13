<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Mon Site' ?></title>
    <link rel="stylesheet" href="path/to/style.css">
</head>
<body>

<header>
    <h1>Mon Site</h1>
</header>

<main>
    <?php echo $content; ?>
</main>

<footer>
    <p>Copyright © <?= date('Y') ?> Mon Site</p>
</footer>

<script src="path/to/script.js"></script>
</body>
</html>
