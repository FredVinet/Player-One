<?php

require_once "../Login/DB_Conn.php";

$joueur = $_SESSION["Id"];

$sqlQuery = "SELECT * FROM t_joueur";


$resultat = mysqli_query($conn, $sqlQuery);
?>
<div class="container">
    <div class="row justify-content-center"> <!-- Centrer les cartes -->
        <div class="col-12">
            <div class="row row-cols-5 g-4"> <!-- Utiliser 5 colonnes -->
                <?php foreach ($resultat as $resultats): ?>
                    <div class="col mb-4">
                        <div class="card bg-dark border-warning-subtle text-center"> <!-- Centrer le contenu de la carte -->
                            <img src="../.<?php echo $resultats['J_Image'] ?>" class="mt-2 rounded-circle" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-warning"><?php echo $resultats['J_Username'] ?></h5>
                                <p class="card-text text-light"><?php echo $resultats['J_Type'] ?></p>
                                <a href="#"><button hreftype="submit" class="btn btn-secondary px-3 border-warning-subtle">Modify</button></a>
                                <a href="#"><button hreftype="submit" class="btn btn-secondary px-3 border-warning-subtle">Delete</button></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ; ?>
            </div>
        </div>
    </div>
</div>

    
