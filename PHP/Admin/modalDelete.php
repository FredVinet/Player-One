<!-- Modal de confirmation pour supprimer -->
<div class="modal fade" id="deleteConfirmationModal<?php echo $resultats['J_Id']; echo $resultats['J_Type']; ?>" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-light" style="background-image: url(../../Assets/CardLogin3.png); background-position: center;">
            <div class="modal-header text-light d-flex justify-content-between">
                <h5 class="modal-title" id="modifyModalLabel">Deletion confirmation</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <img style="width:15px; height:20px;" src="../../Assets/croixBlanche.png" alt="Cross">
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <?php echo $resultats['J_Username'] ?> ? 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <!-- Envoie l'Id et le Type dans l'url -->
                <a id="deleteButton" href="./Delete.php?idDelete=<?php echo $resultats['J_Id'];?>&typeDelete=<?php echo $resultats['J_Type'];?>" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>