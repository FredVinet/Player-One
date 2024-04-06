<?php


if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {

    header("Location: ../../index.php");
    exit();
    
}elseif(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){

    require_once "../DBConnect/DB_Conn.php";

    $joueur = $_SESSION["Id"];
    $sqlQuery = "SELECT * FROM t_joueur";
    $resultat = mysqli_query($conn, $sqlQuery);

}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row row-cols-5 g-4">
                <?php foreach ($resultat as $resultats): ?>
                    <div class="col mb-4">
                        <div class="card bg-dark border-warning-subtle text-center">
                            <img src="../.<?php echo $resultats['J_Image'] ?>" class="mt-2 rounded-circle" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-warning"><?php echo $resultats['J_Username'] ?></h5>
                                <p class="card-text text-light"><?php echo $resultats['J_Type'] ?></p>
                                <a href="#"><button hreftype="submit" class="btn btn-secondary px-3 border-warning-subtle">Modify</button></a>
                                <a href="#"><button hreftype="submit" class="btn btn-secondary px-3 border-warning-subtle" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</button></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour supprimer -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Deletion confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this account ? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a id="deleteButton" href="./Delete.php?id=<?php echo $resultats['J_Id']?>" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>




    
