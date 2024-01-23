<?php include_once 'App/Templates/default/navbar.php'; ?>

<link rel="stylesheet" href="App/Templates/articles/assets/css/style.css">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-8">
            <?php include_once 'App/Templates/default/error.php'; ?>

            <div class="row">
                <?php if (count($formattedArticles) === 0): ?>
                    <div class="col-md-12 mt-3 text-center">
                        <div class="alert alert-warning" role="alert">
                            Aucun article trouvé
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php foreach($formattedArticles as $formattedArticle): ?>
                    <?php
                        $tagNames = array_map(function ($tag) {return $tag->getName();}, $formattedArticle['tags']);
                    ?>
                    <div class="col-md-6 mt-3 filter-item <?= implode(' ', $tagNames) ?>">
                        <a href="/article/show/<?= $formattedArticle['article']->getId() ?>">
                            <div class="card articles" >
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <?php foreach($formattedArticle['tags'] as $tag): ?>
                                            <span class="badge bg-primary"><?= htmlspecialchars($tag->getName()) ?></span>
                                        <?php endforeach; ?>
                                    </div>

                                    <h5 class="card-title font-weight-bold mb-2"><?= $formattedArticle['version']->getTitle() ?></h5>
                                    <p class="card-text">
                                        <i class="far fa-clock pe-2"></i>Créé le : <?= $formattedArticle['createdAt'] ?><br>
                                        <i class="far fa-clock pe-2"></i>Modifié le : <span class="update-date"><?= $formattedArticle['updatedAt'] ?></span>
                                    </p>
                                </div>
                                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </a>
                                </div>
                                <?php if ($formattedArticle['countOfVersions'] > 1): ?>
                                    <div class="card-footer text-end">
                                        <span class="badge bg-info"><?= $formattedArticle['countOfVersions'] ?> versions</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <div class="col-lg-4 mt-3">
            <div class="card mb-4">
                <div class="card-header">Recherche</div>
                <div class="card-body">
                    <div class="input-group">
                        <input id='filterInput' class="form-control filter-input" type="text" placeholder="Catégorie, Titre, ...." aria-label="Catégorie, Titre, .." aria-describedby="button-search" />
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header text-center">Catégories</div>
                <div class="card-body">
                    <div class="row">
                        <?php
                            $halfCount = ceil(count($tagsList) / 2);
                            $leftTags = array_slice($tagsList, 0, $halfCount);
                            $rightTags = array_slice($tagsList, $halfCount);
                        ?>

                        <a data-category="all" href="#" class="text-decoration-none text-center category-link">Réinitialiser</a></li>
                        <div class="col-sm-6 d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled mb-0">
                                <?php foreach($leftTags as $tagEntity): ?>
                                    <li><a data-category="<?= $tagEntity->getName() ?>" href="#" class="text-decoration-none category-link"><?= htmlspecialchars($tagEntity->getName()) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <?php if (count($rightTags) > 0): ?>
                            <div class="col-sm-6 d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled mb-0">
                                    <?php foreach($rightTags as $tagEntity): ?>
                                        <li><a data-category="<?= $tagEntity->getName() ?>" href="#" class="text-decoration-none category-link"><?= htmlspecialchars($tagEntity->getName()) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'App/Templates/default/footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.category-link').on('click', function(event) {
            event.preventDefault();
            
            var selectedCategory = $(this).data('category');
            var articles = $('.filter-item');

            articles.each(function() {
                var isAllCategory = selectedCategory === 'all';
                var isArticleInCategory = $(this).hasClass(selectedCategory);

                $(this).css('display', isAllCategory || isArticleInCategory ? 'block' : 'none');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var filterInput = document.getElementById('filterInput');
        
        // Ajout d'un gestionnaire d'événements pour l'événement input
        filterInput.addEventListener('input', function () {
            // Filtrer le contenu de la liste en fonction de la saisie dans l'input
            filterContent();
        });

        function filterContent() {
            var filterValue = filterInput.value.toLowerCase(); 
            var articles = document.getElementsByClassName('articles');
            for (var i = 0; i < articles.length; i++) {
                var itemText = articles[i].querySelector('.card-title').textContent.toLowerCase();

                console.log(itemText);

                if (itemText.includes(filterValue)) {
                    articles[i].style.display = 'block';
                } else {
                    articles[i].style.display = 'none';
                }
            }
        }
    });

</script>