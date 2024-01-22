<?php include_once 'App/Templates/default/navbar.php'; ?>

<link rel="stylesheet" href="App/Templates/articles/assets/css/style.css">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6 mt-3 filter-item">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold mb-2"></h5>
                    <p class="card-text">
                        <i class="far fa-clock pe-2"></i>Votre clé API: <?= $apiKey ?><br>
                    </p>
                </div>
                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'App/Templates/default/footer.php'; ?>