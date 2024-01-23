<?php include_once 'App/Templates/default/navbar.php'; ?>

<link rel="stylesheet" href="App/Templates/auth/assets/css/style.css">

<div class="container-fluid">
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>

            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1"><?= $user->getFirstname()." ".$user->getLastname() ?></h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        <?php
                            if ($user->getRole() === 'ROLE_ADMIN') {
                                echo "Administrateur";
                            } else {
                                echo "Utilisateur";
                            }
                        ?>
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active " href="" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#regenApiKeyModal">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(603.000000, 0.000000)">
                                                <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                </path>
                                                <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                                                <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">Regénérer une clé d'API</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " href="" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#changePasswordModal">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(154.000000, 300.000000)">
                                                    <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                                                    <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">Changer de mot de passe</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Paramètres</h6>
                    </div>

                    <div class="card-body p-3">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder">Compte</h6>
                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">E-mail des articles commentés</label>
                                </div>
                            </li>

                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Suivi de vos articles (commentaires, ect..)</label>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">E-mail des nouveaux articles</label>
                                </div>
                            </li>

                        </ul>
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">E-mail des MAJ du site</label>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">E-mail des nouvelles versions d'articles suivis</label>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0 pb-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Souscrire à la newsletter</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Informations personnelles</h6>
                            </div>

                            <div class="col-md-4 text-end">
                                <a href="javascript:;">
                                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Prénom:</strong> &nbsp; <?= $user->getFirstname() ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Nom:</strong> &nbsp; <?= $user->getLastname() ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= $user->getEmail() ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Clé API:</strong> &nbsp; <?= $user->getAPIKey() ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Regen Api KEY Modal -->
<div class="modal fade" id="regenApiKeyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Annuler"></button>
            </div>

            <div class="modal-body">Vous êtes sur le point de regénérer une clé d'API, êtes-vous sûr ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-mdb-ripple-init data-mdb-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" data-mdb-ripple-init id="confirmRegenApiKeyBtn">Confirmer</button>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modification de votre mot de passe</h5>
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Annuler"></button>
            </div>

            <form method="POST" action="/compte/change-password" id='changePasswordForm'>
                <div class="modal-body">
                    <div class="form-outline mb-4 mt-4">
                        <input type="password" name="form_old_password" id="form_old_password" class="form-control" required/>
                        <label class="form-label" for="form_old_password">Ancien mot de passe</label>
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="password" name="form_first_new_password" id="form_first_new_password" class="form-control" required/>
                        <label class="form-label" for="form_first_new_password">Nouveau mot de passe</label>
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="password" name="form_second_new_password" id="form_second_new_password" class="form-control" required/>
                        <label class="form-label" for="form_second_new_password">Répétition mot de passe</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-mdb-ripple-init data-mdb-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success" data-mdb-ripple-init>Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'App/Templates/default/footer.php'; ?>

<script type="text/javascript">
    // generation clé api 
    $(document).ready(function() {
        $('#confirmRegenApiKeyBtn').on('click', function() {
            window.location.href = '/compte/regenerate-api-key';
        });
    });

    // modification du mot de passe 
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('changePasswordForm');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(form);
            fetch('/compte/change-password', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    console.log('Opération réussie');
                    window.location.href = '/compte';
                } else {
                    console.log('Erreur côté serveur :', data.error);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la soumission du formulaire :', error);
            });
        });
    });
</script>
