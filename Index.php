<?php
require_once "./PHP/Login/auth.php";
require_once "./PHP/Login/adduser.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="icon" type="Assets/iconeHub" href="./Assets/iconeHub.svg" />
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


            <nav class="navbar navbar-expand-lg navbar-light rounded">

                <div class="container-fluid">
                    <!-- Boutons à gauche -->
                    <a href="./index.php" class="btn btn-dark border-warning-subtle ms-3"> 
                        <i class="fa-solid fa-tent"></i>
                    </a>
                    <!-- <div class="d-flex justify-content-between w-100">
                        <div class="ms-3 dropdown ">
                        <button class="btn btn-dark dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-tent"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bolt me-2"></i>Scoreboard</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-comment me-2"></i></i>Contact Us</a></li>
                        </ul>
                    </div> -->

                    <!-- Boutons à droite -->
                    <div class="d-flex align-items-center gap-3 me-5">
                        <a class="btn btn-dark border-warning-subtle px-3" href="https://github.com/FredVinet/Player-One" target="blank" role="button">
                            <i class="fab fa-github"></i>
                        </a>
                        <?php 
                        if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){
                            
                            echo '<div class="dropdown">
                                        <button class="btn btn-dark px-3 border-warning-subtle dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">'. $_SESSION['Username'] .'</button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="./PHP/Admin/Admin.php"><i class="fa-solid fa-user-secret me-2"></i>Admin</a></li>
                                            <li><a class="dropdown-item" href="./PHP/MonCompte/Account.php"><i class="fa-solid fa-user me-2"></i></i>Account</a></li>
                                            <li><a href="./PHP/Login/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-plane me-2"></i>Disconnect</a></li>
                                        </ul>
                                    </div>';
                        } elseif(isset($_SESSION["User"]) && $_SESSION["User"] == true){
                            echo '<div class="dropdown ">
                                        <button class="btn btn-dark px-3 border-warning-subtle dropdown-toggle border-warning-subtle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">'. $_SESSION['Username'] .'</button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="./PHP/MonCompte/Account.php"><i class="fa-solid fa-user me-2"></i></i>Account</a></li>
                                            <li><a href="./PHP/Login/logout.php" class="dropdown-item" href="#"><i class="fa-solid fa-plane me-2"></i>Disconnect</a></li>
                                        </ul>
                                    </div>';
                        }
                        else {
                            echo '<button hreftype="button" class="btn btn-dark px-3 border-warning-subtle" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
                        }
                        ?>
                        <?php require_once "./modalLogin.php"?>
                    </div>
                </div>

            </nav>

            <?php require_once "./PHP/Admin/ErrorMessage.php"?> 

        </header>

        <main class="m-0 border-0 bd-example border-0 mt-5">

            <?php 
                require_once "./CardShower.php";
            ?> 
            
        </main>    
            
        <?php 
                require_once "./PHP/Footer/footer.php";
        ?>

    </body>
    
</html>