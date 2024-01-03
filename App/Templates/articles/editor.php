<!-- Templates/articles/editor.php -->

<?php ob_start(); ?>

<div class="w-75 mt-3">
    <?php switch ($editorType) {
        case 'create':
            $action = '/article/create';
            $text = 'Créer un article';
            break;
        case 'edit':
            $action = '/article/edit';
            $text = 'Modifier un article';
            break;
        default:
            $action = '';
            $text = '';
    } ?>
    <h1><?= $text ?></h1>
    <form action="/article/create/submit" method="post">
        <div class="form-group mt-3">
            <label for="title">Titre de l'article</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article">
        </div>
        <div class="form-group mt-3">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags (Séparées par une virgule)">
        </div>
        <textarea id="tiny" name="content" class="mt-3"></textarea>
        <button type="submit" class="btn btn-primary w-100 mt-3">Créer</button>
    </form>
</div>
<script>
    $('textarea#tiny').tinymce({
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php include 'base.php'; ?>