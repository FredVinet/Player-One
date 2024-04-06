<?php
session_start();
if (!isset($_SESSION["Admin"]) && $_SESSION["Admin"] != true) {
    header("Location: ../../index.php");
}
require_once "./createUser.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="icon" type="Assets/iconeAdmin" href="../../Assets/iconeAdmin.svg"/>
    <title>Admin</title>
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

                    <button class="btn btn-dark border-warning-subtle" type="button" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div class="modal fade " id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="radius-modal modal-content background-modal bg-dark">
                            <div class="modal-header text-light">
                                <h5 class="modal-title" id="addModalLabel">Create an Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <!-- Pills navs -->

                                    <!-- Pills content -->
                                    <div class="tab-content ">
                                        <div class="tab-pane fade show active mt-3" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                                            <form action="./admin.php" method="POST">

                                                <!-- Id input -->
                                                <div class="form-outline mb-4 ">
                                                    <input type="number" id="idUser" class="form-control" name="idUser"/>
                                                    <label class="form-label text-light" for="createId">Id (Number Only)</label>
                                                </div>
                                                
                                                <!-- Email input -->
                                                <div class="form-outline mb-4 ">
                                                    <input type="email" id="createEmail" class="form-control" name="Email"/>
                                                    <label class="form-label text-light" for="createEmail">Email</label>
                                                </div>

                                                <!-- Username input -->
                                                <div class="form-outline mb-4">
                                                    <input type="text" id="createUsername" class="form-control" name="UserRegister"/>
                                                    <label class="form-label text-light" for="createUsername">Username</label>
                                                </div>

                                                <!-- Password input -->
                                                <div class="form-outline mb-4">
                                                    <input type="password" id="createPassword" class="form-control" name="PwdRegister"/>
                                                    <label class="form-label text-light" for="createPassword">Password</label>
                                                </div>

                                                <!-- Repeat Password input -->
                                                <div class="form-outline mb-4">
                                                    <input type="password" id="createRepeatPassword" class="form-control" name="PwdCheckRegister"/>
                                                    <label class="form-label text-light" for="createRepeatPassword">Repeat password</label>
                                                </div>
                                                
                                                <!-- Type input -->
                                                <div class="form-outline mb-4">
                                                    <input type="text" id="createTypeUser" class="form-control" name="TypeUser"/>
                                                    <label class="form-label text-light" for="createTypeUser">Type (User or Admin)</label>
                                                </div>

                                                <!-- Submit button -->
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" name="submit-create"  class="btn btn-primary btn-block mb-3">Create the account</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-dark border-warning-subtle px-3" href="https://github.com/FredVinet/Player-One" target="blank" role="button">
                        <i class="fab fa-github"></i>
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-dark px-3 border-warning-subtle dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['Username'] ?></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="./Admin.php"><i class="fa-solid fa-user-secret me-2"></i>Admin</a></li>
                            <li><a class="dropdown-item" href="../MonCompte/Account.php"><i class="fa-solid fa-user me-2"></i></i>Account</a></li>
                            <li><a href="../Login/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-plane me-2"></i>Disconnect</a></li>
                        </ul>
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
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal">Fermer</button>
            </div>
            </div>
        </div>
    </div>
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

    

</header>

<main class="mt-5">
        
    <?php 
        if (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true) {
            require_once "./UserShower.php";
        } 
    ?>  
</main>

</body>
</html>