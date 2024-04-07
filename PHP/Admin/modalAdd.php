<!-- Modal d'ajout -->
<div class="modal fade " id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="radius-modal modal-content background-modal bg-dark">
        <div class="modal-header text-light">
            <h5 class="modal-title" id="addModalLabel">Create an Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <!-- Pills content -->
                <div class="tab-content ">
                    <div class="tab-pane fade show active mt-3" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form action="./admin.php" method="POST">

                            <!-- Id input -->
                            <div class="form-outline mb-4 ">
                                <input type="number" id="idUser" class="form-control" name="idUser"/>
                                <label class="form-label text-light" for="createId">Id (Number Only)</label>
                            </div>
                            
                            <!-- Email input -->
                            <div class="form-outline mb-4 ">
                                <input type="email" id="createEmail" class="form-control" name="Email"/>
                                <label class="form-label text-light" for="createEmail">Email</label>
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="createUsername" class="form-control" name="UserRegister"/>
                                <label class="form-label text-light" for="createUsername">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="createPassword" class="form-control" name="PwdRegister"/>
                                <label class="form-label text-light" for="createPassword">Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="createRepeatPassword" class="form-control" name="PwdCheckRegister"/>
                                <label class="form-label text-light" for="createRepeatPassword">Repeat password</label>
                            </div>
                            
                            <!-- Type input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="createTypeUser" class="form-control" name="TypeUser"/>
                                <label class="form-label text-light" for="createTypeUser">Type (User or Admin)</label>
                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit-create"  class="btn btn-primary btn-block mb-3">Create the account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>