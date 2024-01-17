<?php include_once 'App/Templates/default/navbar.php'; ?>

<style>
    .select-container {
        display: inline-block;
        max-width: 100%;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <article class="text-center">
                <header class="mb-4">
                    <h3 class="fw-bolder mb-1" id="articleTitle"><?= $formattedArticle['lastVersion']->getTitle() ?></h3>
                    <div class="text-muted fst-italic mb-2">
                        Posté le <?= $formattedArticle['article']->getCreatedAt() ?> par <?= $formattedArticle['createdByUsername'] ?><br>
                        Dernière modification le <span id="articleUpdatedAt"><?= $formattedArticle['lastVersion']->getUpdatedAt() ?></span>
                    </div>

                    <?php foreach($formattedArticle['tags'] as $tag): ?>
                        <span class="badge bg-secondary text-decoration-none link-light"><?= htmlspecialchars($tag->getName()) ?></span>
                    <?php endforeach; ?>

                    <br><label for="versionSelect" class="form-label mt-4">Sélectionner une version :</label>
                    <div class="select-container">
                        <select id="versionSelect" class="form-select text-center">
                            <?php foreach($formattedArticle['versions'] as $version): ?>
                                <?php $selected = ($version->getId() == $formattedArticle['lastVersion']->getId()) ? 'selected' : ''; ?>
                                <option value="<?= $version->getId() ?>" <?= $selected ?>><?= $version->getTitle() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </header>

                <hr>
                <section class="mb-5" id="articleContent">
                    <?= $formattedArticle['lastVersion']->getContent() ?>
                </section>
            </article>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var versions = [];

        <?php foreach($formattedArticle['versions'] as $version): ?>
            versions.push({
                id: <?= $version->getId() ?>,
                title: "<?= $version->getTitle() ?>",
                content: `<?= $version->getContent() ?>`,
                updatedAt: "<?= $version->getUpdatedAt() ?>"
            });
        <?php endforeach; ?>

        $('#versionSelect').on('change', function() {
            var selectedVersionId = $(this).val();
            var selectedVersion = versions.find(function(version) {return version.id == selectedVersionId});

            $('#articleContent').html(selectedVersion.content);
            $('#articleTitle').html(selectedVersion.title);
            $('#articleUpdatedAt').html(selectedVersion.updatedAt);
        });
    });
</script>


<?php include_once 'App/Templates/default/footer.php'; ?>