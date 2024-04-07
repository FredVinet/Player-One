<?php
session_start();
if (!isset($_SESSION["Admin"]) && $_SESSION["Admin"] != true) {
    header("Location: ../Home/index.php");
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


    <header class="p-3 m-0 border-0 bd-example m-0 border-0">


        <nav class="navbar navbar-expand-lg navbar-light rounded mb-5">
            <div class="container-fluid">
                <div class="d-flex justify-content-between w-100">
                    <!-- Bouton à gauche -->
                    <a href="../Home/index.php" class="btn btn-dark border-warning-subtle ms-3"> 
                        <i class="fa-solid fa-tent"></i>
                    </a>
                    <!-- <div class="ms-3 dropdown ">
                        <button class="btn btn-dark dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-tent"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="../Home/index.php"><i class="fa-solid fa-house me-2"></i>Home</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bolt me-2"></i>Scoreboard</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-comment me-2"></i>Contact Us</a></li>
                        </ul>
                    </div> -->

                    <!-- Bouton à droite -->
                    <div class="d-flex align-items-center gap-3 me-5">

                        <button class="btn btn-dark border-warning-subtle" type="button" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                        <!-- Affiche la modal d'ajout quand le bouton est cliquer -->
                        <?php require_once "./modalAdd.php" ?>

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
        <!-- Affiche les messages d'erreurs -->
        <?php require_once "./ErrorMessage.php"; ?> 


    </header>

    <main class="mt-5">
            
        <!-- Affiche tout les utilisateurs -->
        <?php 
            if (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true) {
                require_once "./UserShower.php";
            } 
        ?>  
        
    </main>

</body>
</html>