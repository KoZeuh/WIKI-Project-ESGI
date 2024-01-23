<?php include_once 'App/Templates/default/navbar.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <article class="text-center">
                <header class="mb-4">
                    <h3 class="fw-bolder mb-1"
                        id="articleTitle"><?= $formattedArticle['lastVersion']->getTitle() ?></h3>
                    <div class="text-muted fst-italic mb-2">
                        Posté le <?= $formattedArticle['article']->getCreatedAt() ?>
                        par <?= $formattedArticle['createdByUsername'] ?><br>
                        Dernière modification le <span
                                id="articleUpdatedAt"><?= $formattedArticle['lastVersion']->getUpdatedAt() ?></span>
                    </div>

                    <?php foreach ($formattedArticle['tags'] as $tag): ?>
                        <span class="badge bg-secondary text-decoration-none link-light"><?= htmlspecialchars($tag->getName()) ?></span>
                    <?php endforeach; ?>

                    <br><label for="versionSelect" class="form-label mt-4">Sélectionner une version :</label>
                    <div style="display: inline-block; max-width: 100%;">
                        <select id="versionSelect" class="form-select text-center">
                            <?php foreach ($formattedArticle['versions'] as $version): ?>
                                <?php if ($version->getIsValid() === 0) continue; ?>

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

    <hr>

    <div class="row d-flex justify-content-center">
        <?php if (isset($_SESSION['user']) && $_SESSION['user'] != null): ?>
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        <div class="form-outline mb-4">
                            <form method="POST" action="/commentaire/addComment/<?= $articleId ?>" id='addCommentForm'>
                                <input type="text" id="addComment" name="addComment" class="form-control"
                                       placeholder="Type comment..."/>
                                <label class="form-label" for="addANote">+ Ajouter un commentaire</label>
                                <button type="submit" class="btn btn-success mt-4" data-mdb-ripple-init>Confirmer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12 col-lg-10 mt-2">
            <div class="card shadow-0 border text-dark" style="background-color: #f0f2f5;">
                <h4 class="p-2">Commentaire(s) récent(s)</h4>
                <?php foreach ($formattedArticle['comments'] as $comment): ?>
                    <div class="card-body">
                        <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                                 src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp" alt="avatar"
                                 width="60" height="60"/>
                            <div>
                                <h6 class="fw-bold mb-1"><?= $comment['createdByUsername'] ?></h6>
                                <div class="d-flex align-items-center mb-3">
                                    <p class="mb-0"><?= $comment['createdAt'] ?> <span
                                                class="badge bg-success">Validé</span>
                                    </p>

                                    <?php if ($comment['createdByUsername'] === $_SESSION['user']->getUsername() || $_SESSION['user']->getRole() === 'ROLE_ADMIN'): ?>
                                        <a href="" data-mdb-ripple-init data-mdb-modal-init
                                           data-mdb-target="#confirmCommentDeleteModal"
                                           data-commentaire-id="<?= $comment['comment']->getId() ?>" class="link-muted"><i
                                                    class="fas fa-trash ms-2 text-danger"></i></a>
                                    <?php endif; ?>
                                </div>

                                <p class="mb-0">
                                    <?= $comment['comment']->getContent() ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-0"/>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Comment Confirmation -->
<div class="modal fade" id="confirmCommentDeleteModal" tabindex="-1" aria-labelledby="confirmCommentDeleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCommentDeleteModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                        aria-label="Annuler"></button>
            </div>
            <div class="modal-body">Vous êtes sur le point de supprimer un commentaire, êtes-vous sûr ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-mdb-ripple-init data-mdb-dismiss="modal">Annuler
                </button>
                <button type="button" class="btn btn-success" data-mdb-ripple-init id="confirmCommentDeleteBtn">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<?php include_once 'App/Templates/default/footer.php'; ?>

<script>
    $(document).ready(function () {
        var versions = [];

        <?php foreach($formattedArticle['versions'] as $version): ?>
        versions.push({
            id: <?= $version->getId() ?>,
            title: "<?= $version->getTitle() ?>",
            content: `<?= $version->getContent() ?>`,
            updatedAt: "<?= $version->getUpdatedAt() ?>"
        });
        <?php endforeach; ?>

        $('#versionSelect').on('change', function () {
            var selectedVersion = versions.find(function (version) {
                return version.id == $(this).val()
            });

            $('#articleContent').html(selectedVersion.content);
            $('#articleTitle').html(selectedVersion.title);
            $('#articleUpdatedAt').html(selectedVersion.updatedAt);
        });

        $('#confirmCommentDeleteModal').on('show.bs.modal', function (event) {
            $('#confirmCommentDeleteBtn').on('click', function () {
                window.location.href = '/commentaire/remove/' + $(event.relatedTarget).data('commentaire-id');
            });
        });
    });
</script>