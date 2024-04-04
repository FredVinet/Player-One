<?php
session_start();
if (isset ($_SESSION["Loggedin"])) {
    $userpseudo = $_SESSION['Username'];
    $UserType = $_SESSION['UserType'];
    $UserImage = $_SESSION['Image'];
    $UserId = $_SESSION['Id'];
}  else {
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="icon" type="Assets/iconeAdmin" href="../../Assets/iconeAccount.svg" />
    <title>Account</title>
    <link rel="stylesheet" href="../../Css/moncompte.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/27c1d8786e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<body>
<header class="p-3 m-0 border-0 bd-example m-0 border-0">


<nav class="navbar navbar-expand-lg navbar-light rounded mb-5">
    <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
            <!-- Bouton GitHub à gauche -->
            <div class="ms-3 dropdown ">
                <button class="btn btn-dark dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-tent"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="../../index.php"><i class="fa-solid fa-house me-2"></i>Home</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bolt me-2"></i>Scoreboard</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-comment me-2"></i>Contact Us</a></li>
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
                <a class="btn btn-dark border-warning-subtle px-3" href="https://github.com/FredVinet/Player-One" target="blank" role="button">
                    <i class="fab fa-github"></i>
                </a>
                <?php 
                   if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){
                        header("Location: ../../index.php");
                   } elseif(isset($_SESSION["User"]) && $_SESSION["User"] == true){
                    echo '<div class="dropdown ">
                                <button class="btn btn-dark px-3 border-warning-subtle dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">'. $_SESSION['Username'] .'</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="./Account.php"><i class="fa-solid fa-user me-2"></i></i>Account</a></li>
                                    <li><a href="../Login/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-plane me-2"></i>Disconnect</a></li>
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

<main>
    <div class="container mt-5">
        <!-- Utilisez "justify-content-center" pour centrer les éléments de la grille -->
        <div class="row justify-content-center">
            <!-- Ajustez les classes de colonne pour définir la largeur de la carte sur différentes tailles d'écran -->
            <div class="col-10 col-md-4 col-lg-4">
                <div class="card bg-dark border-warning-subtle">
                    <img src="../.<?php echo $UserImage ?>" class="mt-3 rounded-circle" style=" max-width: 200px; height: auto; margin: 0 auto;" alt="...">
                    <div class="card-body mt-3">
                    <?php 
                   if(isset($_SESSION['Loggedin'])){
                       echo '<h5 class="card-title text-warning text-center">' . $userpseudo . '</h5>';
                       echo '<h5 class="card-text text-warning text-center">' . $UserType  . '</h5>';         
                   }
                ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




</header>
</body>
</html>