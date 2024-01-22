<?php include_once 'App/Templates/default/navbar.php'; ?>

    <div class="w-80 mt-3">
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
        <form action="<?= $action ?>/submit" method="post">
            <div class="form-group mt-3">
                <label for="title">Titre de l'article</label>
                <input type="text" class="form-control" id="title" name="title"
                       placeholder="Titre de l'article" <?php
                if ($editorType === 'edit') {
                    echo 'value="' . $lastVersion->getTitle() . '"';
                }
                ?>>
                <?php if ($editorType === 'edit'): ?>
                    <input type="hidden" name="article_id" value="<?= $lastVersion->getArticleId() ?>">
                <?php endif; ?>
            </div>
            <div class="form-group mt-3">
                <label for="tags">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags"
                       placeholder="Tags (Séparées par une virgule)" <?php
                if ($editorType === 'edit') {
                    echo 'value="' . $tagInString . '"';
                }
                ?>>
            </div>
            <textarea id="tiny" name="content" class="mt-3"><?php
                if ($editorType === 'edit') {
                    echo $lastVersion->getContent();
                }
                ?></textarea>
            <button type="submit" class="btn btn-primary w-100 mt-3">Créer</button>
        </form>
    </div>
<?php include_once 'App/Templates/default/footer.php'; ?>