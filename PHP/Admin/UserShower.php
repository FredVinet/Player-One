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
                                <a href="#"><button hreftype="submit" class="btn btn-secondary px-3 border-warning-subtle" data-bs-toggle="modal" data-bs-target="#modifyModal">Modify</button></a>
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
        <a id="deleteButton" href="./Delete.php?idDelete=<?php echo $resultats['J_Id']?>" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal de modification -->
<div class="modal fade " id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="radius-modal modal-content background-modal bg-dark">
        <div class="modal-header text-light">
            <h5 class="modal-title" id="modifyModalLabel">Modify Pannel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content ">
                    <div class="tab-pane fade show active mt-3" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form action="./Modify.php?idchange=<?php echo $resultats['J_Id']?>" method="POST">

                            <!-- Id input -->
                            <div class="form-outline mb-4 ">
                                <input type="number" id="changeidUser" class="form-control" name="idUserChange"/>
                                <label class="form-label text-light" for="changeidUser">Id (Number Only)</label>
                            </div>
                            
                            <!-- Email input -->
                            <div class="form-outline mb-4 ">
                                <input type="email" id="changeEmail" class="form-control" name="EmailChange"/>
                                <label class="form-label text-light" for="changeEmail">Email</label>
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="changeUsername" class="form-control" name="UserRegisterChange"/>
                                <label class="form-label text-light" for="changeUsername">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="changePassword" class="form-control" name="PwdRegisterChange"/>
                                <label class="form-label text-light" for="changePassword">Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="changeRepeatPassword" class="form-control" name="PwdCheckRegisterChange"/>
                                <label class="form-label text-light" for="changeRepeatPassword">Repeat password</label>
                            </div>
                            
                            <!-- Type input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="changeTypeUser" class="form-control" name="TypeUserChange"/>
                                <label class="form-label text-light" for="changeTypeUser">Type (User or Admin)</label>
                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit-change"  class="btn btn-primary btn-block mb-3">Update Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal pour les messages d'erreur de changements -->
<div class="modal fade" id="errorModalchange" tabindex="-1" aria-labelledby="errorModalchangeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="errorModalchangeLabel">Error in changes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="errorMessageschange">
            <!-- Les messages d'erreur sont affichés ici -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#">Close</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modifyModal">Return</button>
        </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (!empty($_SESSION['errorschange'])): ?>
            // Convertit les messages d'erreur PHP en HTML
            var errorsHtml = "<?php echo implode('<br>', $_SESSION['errorschange']); ?>";
            document.getElementById('errorMessageschange').innerHTML = errorsHtml;

            // Affiche la modal d'erreur
            var errorModalChange = new bootstrap.Modal(document.getElementById('errorModalchange'));
            errorModalChange.show();

            // Efface les messages d'erreur de la session pour éviter l'affichage répétitif
            <?php unset($_SESSION['errorschange']); ?>
        <?php endif; ?>
    });
</script>



    
