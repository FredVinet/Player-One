<!-- Modal de modification -->
<div class="modal fade" id="modifyModal<?php echo $resultats['J_Id']; ?>" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="radius-modal modal-content background-modal bg-dark">
        <div class="modal-header text-light">
            <h5 class="modal-title" id="modifyModalLabel">Modify Pannel</h5>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>     
        </div>
            <div class="modal-body">
                <div class="tab-content ">
                    <div class="tab-pane fade show active mt-3" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <!-- Envoie l'Id dans l'url -->
                        <form action="./Modify.php?idchange=<?php echo $resultats['J_Id']?>" method="POST">

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="changeUsername" class="form-control" name="UserRegisterChange" value="<?php echo $resultats['J_Username']; ?>"/>
                                <label class="form-label text-light" for="changeUsername">New Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="changePassword" class="form-control" name="PwdRegisterChange"/>
                                <label class="form-label text-light" for="changePassword">New Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="changeRepeatPassword" class="form-control" name="PwdCheckRegisterChange"/>
                                <label class="form-label text-light" for="changeRepeatPassword">Repeat password</label>
                            </div>
                            
                            <!-- Type input -->
                            <div class="form-outline mb-4">
                                <select class="form-select" id="changeTypeUser" name="TypeUserChange">
                                    <option value="User" <?php echo $resultats['J_Type'] === 'User' ? 'selected' : ''; ?>>User</option>
                                    <option value="Admin" <?php echo $resultats['J_Type'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                                <label class="form-label text-light" for="changeTypeUser">New Type (User or Admin)</label>
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