<?php
require_once "./PHP/Login/auth.php";
require_once "./PHP/Login/adduser.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Player One</title>
    <link rel="stylesheet" href="./Css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/27c1d8786e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>


    <header class="p-3 m-0 border-0 bd-example m-0 border-0">


    <nav class="navbar navbar-expand-lg navbar-light rounded mb-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between w-100">
                <!-- Bouton GitHub à gauche -->
                <div class="ms-3 dropdown ">
                <button class="btn btn-dark dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-tent"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bolt me-2"></i>Scoreboard</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-comment me-2"></i>Contact Us</a></li>
                </ul>
            </div>

                <!-- Espace du milieu (facultatif, peut être utilisé pour d'autres liens ou titres) -->
                <div class="collapse navbar-collapse " id="navbarButtonsExample">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
                        <!-- Liens du milieu si nécessaire -->
                    </ul>
                </div>

                <!-- Bouton Login à droite -->
                <div class="d-flex align-items-center gap-3 me-5">
                    <a class="btn btn-dark border-warning-subtle px-3" href="https://github.com/FredVinet/VitrineCasseBrique" target="blank" role="button">
                        <i class="fab fa-github"></i>
                    </a>
                    <?php 
                       if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){
                        
                           echo '<div class="dropdown">
                                    <button class="btn btn-dark px-3 border-warning-subtle dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">'. $_SESSION['Username'] .'</button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="./Admin.php"><i class="fa-solid fa-user-secret me-2"></i>Admin</a></li>
                                        <li><a class="dropdown-item" href="./Account.php"><i class="fa-regular fa-user me-2"></i>Account</a></li>
                                        <li><a href="./PHP/Login/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-plane me-2"></i>Disconnect</a></li>
                                    </ul>
                                </div>';
                       } elseif(isset($_SESSION["User"]) && $_SESSION["User"] == true){
                        echo '<div class="dropdown ">
                                    <button class="btn btn-dark px-3 border-warning-subtle dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">'. $_SESSION['Username'] .'</button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="./Account.php"><i class="fa-regular fa-user me-2"></i>Account</a></li>
                                        <li><a href="./PHP/Login/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-plane me-2"></i>Disconnect</a></li>
                                    </ul>
                                </div>';
                       }
                       else {
                            echo '<button hreftype="button" class="btn btn-dark px-3 border-warning-subtle" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
                       }
                    ?>
                    <div class="modal fade " id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="radius-modal modal-content background-modal">
                                
                                <div class="modal-body">
                                    <!-- Pills navs -->
                                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                                        </li>
                                    </ul>
                                    <!-- Pills navs -->

                                    <!-- Pills content -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                                            <form action="index.php" method="POST">
                                                <div class="text-center mb-3 text-light">
                                                    <p>Sign in with :</p>
                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-facebook-f"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-google"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-twitter"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-github"></i>
                                                    </button>
                                                </div>

                                                <p class="text-light text-center ">or :</p>

                                                <!-- Email input -->
                                                <div class="form-outline mb-4">
                                                    <input type="text" id="loginName" class="form-control" name="Username" />
                                                    <label class="form-label text-light" for="loginName">Username</label>
                                                </div>

                                                <!-- Password input -->
                                                <div class="form-outline mb-4 ">
                                                    <input type="password" id="loginPassword" class="form-control" name="Password"/>
                                                    <label class="form-label text-light" for="loginPassword">Password</label>
                                                </div>

                                                <!-- 2 column grid layout -->
                                                <div class="row mb-4">
                                                    <div class="col-md-6 d-flex justify-content-center">
                                                    <!-- Checkbox -->
                                                    <div class="form-check mb-3 mb-md-0">
                                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                                        <label class="form-check-label text-light" for="loginCheck"> Remember me </label>
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6 d-flex justify-content-center">
                                                    <!-- Simple link -->
                                                    <a href="#!">Forgot password?</a>
                                                    </div>
                                                </div>

                                                <!-- Submit button -->
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                                                </div>
                                                <!-- Register buttons -->
                                                <div class="text-center">
                                                    <p class="text-light">Not a member? <a href="#!">Register</a></p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                                            <form action="index.php" method="POST">
                                                <div class="text-center mb-3 text-light">
                                                    <p>Sign in with :</p>
                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-facebook-f"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-google"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-twitter"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                                    <i class="fab fa-github"></i>
                                                    </button>
                                                </div>

                                                <p class="text-center text-light">or :</p>

                                                <!-- Email input -->
                                                <div class="form-outline mb-4">
                                                    <input type="email" id="registerEmail" class="form-control" name="Email"/>
                                                    <label class="form-label text-light" for="registerEmail">Email</label>
                                                </div>

                                                <!-- Username input -->
                                                <div class="form-outline mb-4">
                                                    <input type="text" id="registerUsername" class="form-control" name="UserRegister"/>
                                                    <label class="form-label text-light" for="registerUsername">Username</label>
                                                </div>

                                                <!-- Password input -->
                                                <div class="form-outline mb-4">
                                                    <input type="password" id="registerPassword" class="form-control" name="PwdRegister"/>
                                                    <label class="form-label text-light" for="registerPassword">Password</label>
                                                </div>

                                                <!-- Repeat Password input -->
                                                <div class="form-outline mb-4">
                                                    <input type="password" id="registerRepeatPassword" class="form-control" name="PwdCheckRegister"/>
                                                    <label class="form-label text-light" for="registerRepeatPassword">Repeat password</label>
                                                </div>

                                                <!-- Checkbox -->
                                                <div class="form-check d-flex justify-content-center mb-4">
                                                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                                                    aria-describedby="registerCheckHelpText" />
                                                    <label class="form-check-label text-light" for="registerCheck">
                                                    I have read and agree to the terms
                                                    </label>
                                                </div>

                                                <!-- Submit button -->
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" name="submit-register"  class="btn btn-primary btn-block mb-3">Sign up</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <!-- Modal pour les messages d'erreur -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Erreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorMessages">
                <!-- Les messages d'erreur seront injectés ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">Fermer</button>
            </div>
            </div>
        </div>
    </div>



    </header>

    <main class="m-0 border-0 bd-example border-0 mt-5">


        <div id="carouselExampleIndicators" class="carousel slide" >
            
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>

            <div class="carousel-inner mb-5">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row align-items-start gap-3">
                            <div class="container">
                                <div class="row align-items-start gap-4">

                                    <div class="card col bg-dark border-warning-subtle" style="width: 18rem;">
                                        <img src="./Assets/DefaultCB.png" class="mt-3 rounded" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">Card title</h5>
                                            <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#"><button hreftype="button" class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>

                                    <div class="card col bg-dark border-warning-subtle" style="width: 18rem;">
                                        <img src="./Assets/DefaultCB.png" class="mt-3 rounded" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">Card title</h5>
                                            <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#"><button hreftype="button" class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>

                                    <div class="card col bg-dark border-warning-subtle" style="width: 18rem;">
                                        <img src="./Assets/DefaultCB.png" class="mt-3 rounded" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">Card title</h5>
                                            <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#"><button hreftype="button" class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="container">
                        <div class="row align-items-start gap-3">
                            <div class="container">
                                <div class="row align-items-start gap-3">

                                    <div class="card col bg-dark border-warning-subtle" style="width: 18rem;">
                                        <img src="./Assets/Default2CB.png" class="mt-3 rounded" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">Card title</h5>
                                            <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#"><button hreftype="button" class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>

                                    <div class="card col bg-dark border-warning-subtle" style="width: 18rem;">
                                        <img src="./Assets/Default2CB.png" class="mt-3 rounded" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">Card title</h5>
                                            <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#"><button hreftype="button" class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>

                                    <div class="card col bg-dark border-warning-subtle" style="width: 18rem;">
                                        <img src="./Assets/Default2CB.png" class="mt-3 rounded" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">Card title</h5>
                                            <p class="card-text text-light">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#"><button hreftype="button" class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            

        </div>

        
    </main>



    <footer class="text-center bg-body-dark m-3 border-0 bd-example m-0 border-0 mt-5">
        <div class="container pt-4">
            <section class="mb-4">
            <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating link-warning border-warning-subtle btn-lg text-light m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-facebook-f"></i
            ></a>
            <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating link-warning border-warning-subtle btn-lg text-light m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-twitter"></i
            ></a>
            <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating link-warning border-warning-subtle btn-lg text-light m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-google"></i
            ></a>
            <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating link-warning border-warning-subtle btn-lg text-light m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-instagram"></i
            ></a>
            <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating link-warning border-warning-subtle btn-lg text-light m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-linkedin"></i
            ></a>
            <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating link-warning border-warning-subtle btn-lg text-light m-1"
                target="blank"
                href="https://github.com/FredVinet"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-github"></i
            ></a>
            </section>
        </div>
        <div class="text-center text-light p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-light link-warning" href="#">BrickBreaker.com</a>
        </div>
    </footer>



    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            <?php if (!empty($_SESSION['errors'])): ?>
                // Convertit les messages d'erreur PHP en HTML
                var errorsHtml = "<?php echo implode('<br>', $_SESSION['errors']); ?>";
                document.getElementById('errorMessages').innerHTML = errorsHtml;

                // Affiche la modal d'erreur
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();

                // Efface les messages d'erreur de la session pour éviter l'affichage répétitif
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
        });
    </script>
             
             
</body>
</html>