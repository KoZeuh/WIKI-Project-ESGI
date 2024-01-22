<?php include_once 'App/Templates/default/navbar.php'; ?>

<link rel="stylesheet" href="App/Templates/auth/assets/css/style.css">

<body class="background-radial-gradient overflow-hidden">
    <div class="container-fluid px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)"> The best offer <br />
                    <span style="color: hsl(218, 81%, 75%)">for your business</span>
                </h1>

                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Temporibus, expedita iusto veniam atque, magni tempora mollitia
                    dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                    ab ipsum nisi dolorem modi. Quos?
                </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <form method="POST" action="/register">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name = "form_register_firstname" id="form_register_firstname" class="form-control" required />
                                        <label class="form-label" for="form_register_firstname">Prénom*</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="form_register_lastname" id="form_register_lastname" class="form-control" required />
                                        <label class="form-label" for="form_register_lastname">Nom*</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="email" name="form_register_email" id="form_register_email" class="form-control" required />
                                        <label class="form-label" for="form_register_email">Email*</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="form_register_username" id="form_register_username" class="form-control" required />
                                        <label class="form-label" for="form_register_ysername">Pseudo*</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="form_register_password" id="form_register_password" class="form-control" required/>
                                <label class="form-label" for="form_register_password">Mot de passe*</label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-4">S'inscrire</button>

                            <?php include_once 'App/Templates/default/error.php'; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once 'App/Templates/default/footer.php'; ?>