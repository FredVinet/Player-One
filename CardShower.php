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
    <div class="carousel-inner mb-5">
            <?php foreach ($groupes as $index => $groupe): ?>
                <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                    <div class="container">
                        <div class="row justify-content-center gap-3 mb-5">
                            <?php foreach ($groupe as $carte): ?>
                                <div class="col-md-3 mb-5 d-flex align-items-stretch">
                                    <div class="card bg-dark border-warning-subtle">
                                        <img src="<?php echo $carte['CB_Image']; ?>" class="mt-4 ms-3 me-3 rounded-circle d-block mx-auto" alt="...">
                                        <div class="card-body ">
                                            <h5 class="card-title text-warning text-center"><?php echo $carte['CB_Nom']; ?></h5>
                                            <p class="card-text text-light">Créateur/rice : <?php echo $carte['CB_Createur']; ?></p>
                                            <p class="card-text text-info"><?php echo $carte['CB_Type']; ?></p>
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