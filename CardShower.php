<?php

require_once "./PHP/DBConnect/DB_Conn.php";

if ($conn) {
    $sqlQuery = "SELECT * FROM t_cassebrique";
    $resultat = mysqli_query($conn, $sqlQuery);

    // Convertir le résultat en tableau
    $resultats = mysqli_fetch_all($resultat, MYSQLI_ASSOC);

    // Diviser le tableau en sous-tableaux de 3 éléments
    $groupes = array_chunk($resultats, 3);

}
?>

<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
             <?php foreach ($groupes as $index => $groupe): ?> <!-- Parcours le sous tableau $groupe qui répresente un groupe carte de casse-briques -->
                 <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>"><!-- Détermine quel élément du carousel est actif -->
                    <div class="container">
                        <div class="row justify-content-center gap-3">
                             <?php foreach ($groupe as $carte): ?> <!-- Parcours le talbeau associatif $carte qui représente les données d'une carte de casse-briques dans le groupe en cours d'itération.  -->
                                <div class="col-md-3 mb-5 d-flex align-items-stretch">
                                    <div class="card bg-dark border-warning-subtle">
                                        <!-- Affiche l'image de l'utilisateur -->
                                        <img src="<?php echo $carte['CB_Image']; ?>" class="mt-4 ms-3 me-3 rounded-circle d-block mx-auto" alt="...">
                                        <div class="card-body ">
                                            <!-- Affiche le Nom du casse-brique -->
                                            <h5 class="card-title text-warning text-center"><?php echo $carte['CB_Nom']; ?></h5>
                                            <!-- Affiche le Nom de créateur du casse brique -->
                                            <p class="card-text text-light">Créateur/rice : <?php echo $carte['CB_Createur']; ?></p>
                                            <!-- Affiche le type de Casse-brique (Solo ou Multiplayer ou les deux) -->
                                            <p class="card-text text-info"><?php echo $carte['CB_Type']; ?></p>
                                            <!-- Bouton pour lancer le jeu (Pas encore mis en place) -->
                                            <a href="#"><button class="btn btn-secondary px-3 border-warning-subtle">Launch Game</button></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

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