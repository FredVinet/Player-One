<?php


if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {
    //Si l'utilisateur n'est pas Admin renvoie sur la page d'accueil
    header("Location: ../../index.php");
    exit();
    
}elseif(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){//Si l'utilisateur est Admin ouvre dans la base de données

    require_once "../DBConnect/DB_Conn.php";

    //Mise en place des variables
    $joueur = $_SESSION["Id"];

    //Selection de toutes les colonnes et toutes les lignes de la table t_joueur
    $sqlQuery = "SELECT * FROM t_joueur";
    $resultat = mysqli_query($conn, $sqlQuery);

    // Convertir le résultat en tableau
    $resultats = mysqli_fetch_all($resultat, MYSQLI_ASSOC);

    // Diviser le tableau en sous-tableaux de 4 éléments
    $groupes = array_chunk($resultats, 4);
}
?>

<!-- Carousel de toutes les utilisateurs -->
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-inner mb-5">
        <?php foreach ($groupes as $index => $groupe): ?>
            <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            <div class="row row-cols-4 g-4">
                                <?php foreach ($groupe as $resultats): ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card bg-dark border-warning-subtle">
                                            <!-- Affiche l'image de l'utilisateur -->
                                            <img src="../.<?php echo $resultats['J_Image'] ?>" class="mt-2 rounded-circle w-75 mx-auto" alt="...">
                                            <div class="card-body ">
                                                <!-- Affiche son username -->
                                                <h5 class="card-title text-warning  text-center text-sm"><?php echo $resultats['J_Username'] ?></h5>
                                                <!-- Affiche le type d'utilisateur -->
                                                <p class="card-text text-light  text-center text-xs"><?php echo $resultats['J_Type'] ?></p>

                                                <div class="d-flex justify-content-center">

                                                    <!-- Renvoie l'id de l'utilisateur que l'admin veut modifier ou supprimer -->
                                                    <!-- Bouton de modification-->
                                                    <a href="#" class="btn btn-secondary px-3 border-warning-subtle me-2" data-bs-toggle="modal" data-bs-target="#modifyModal<?php echo $resultats['J_Id']; ?>">Modify</a>
                                                    <!-- Bouton de suppression -->
                                                    <a href="#" class="btn btn-secondary px-3 border-warning-subtle" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal<?php echo $resultats['J_Id']; echo $resultats['J_Type']; ?>">Delete</a>

                                                </div>
                                                <!-- Modal de modification -->
                                                <?php require "./modalModify.php"; ?>
                                                <!-- Modal de suppression -->
                                                <?php require "./modalDelete.php"; ?> 

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Si il y a moins de 6 utilisateurs les boutons Précedent et Suivant ne se montre pas -->
    <?php if (count($groupes) > 1): ?>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
<?php endif; ?>
</div>


<!-- Message d'erreur -->
<?php require_once "./ErrorMessage.php"; ?>