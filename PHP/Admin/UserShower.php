<?php


if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {

    header("Location: ../../index.php");
    exit();
    
}elseif(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){

    require_once "../DBConnect/DB_Conn.php";

    $joueur = $_SESSION["Id"];

    $sqlQuery = "SELECT * FROM t_joueur";
    $resultat = mysqli_query($conn, $sqlQuery);

    // Convertir le résultat en tableau
    $resultats = mysqli_fetch_all($resultat, MYSQLI_ASSOC);

    // Diviser le tableau en sous-tableaux de 10 éléments
    $groupes = array_chunk($resultats, 5);
}
?>
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-inner mb-5">
        <?php foreach ($groupes as $index => $groupe): ?>
            <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row row-cols-5 g-4">
                                <?php foreach ($groupe as $resultats): ?>
                                    <div class="col mb-4">
                                        <div class="card bg-dark border-warning-subtle">
                                            <img src="../.<?php echo $resultats['J_Image'] ?>" class="mt-2 rounded-circle" alt="...">
                                            <div class="card-body ">
                                                <h5 class="card-title text-warning  text-center"><?php echo $resultats['J_Username'] ?></h5>
                                                <p class="card-text text-light  text-center"><?php echo $resultats['J_Type'] ?></p>
                                                <div class="d-flex justify-content-center"> <!-- Wrap buttons in d-flex -->
                                                    <!-- Modify button -->
                                                    <a href="#" class="btn btn-secondary px-3 border-warning-subtle me-2" data-bs-toggle="modal" data-bs-target="#modifyModal<?php echo $resultats['J_Id']; ?>">Modify</a>
                                                    
                                                    <!-- Delete button -->
                                                    <a href="#" class="btn btn-secondary px-3 border-warning-subtle" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal<?php echo $resultats['J_Id']; ?>">Delete</a>
                                                </div>
                                                <?php 
                                                    require "./modalModify.php";
                                                ?>
                                                
                                                <?php 
                                                    require "./modalDelete.php";
                                                ?> 
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

<?php 
    require_once "./ErrorMessage.php";
?> 



    