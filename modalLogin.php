<!-- Modal de Login et Register -->
<div class="modal fade " id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="radius-modal modal-content background-modal">
            
            <div class="modal-body">
                <!-- Pills navs -->
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form action="index.php" method="POST">
                            <div class="text-center mb-3 text-light">
                                <p>Sign in with :</p>
                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-google"></i>
                                </button>

                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-github"></i>
                                </button>
                            </div>

                            <p class="text-light text-center ">or :</p>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="loginName" class="form-control" name="Username" />
                                <label class="form-label text-light" for="loginName">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4 ">
                                <input type="password" id="loginPassword" class="form-control" name="Password"/>
                                <label class="form-label text-light" for="loginPassword">Password</label>
                            </div>

                            <!-- 2 column grid layout -->
                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-3 mb-md-0">
                                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                    <label class="form-check-label text-light" for="loginCheck"> Remember me </label>
                                </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                <!-- Simple link -->
                                <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                            </div>
                            <!-- Register buttons -->
                            <div class="text-center">
                                <p class="text-light">Not a member? <a href="#!">Register</a></p>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form action="index.php" method="POST">
                            <div class="text-center mb-3 text-light">
                                <p>Sign in with :</p>
                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-google"></i>
                                </button>

                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-link link-warning border-warning-subtle btn-floating mx-1 text-light">
                                <i class="fab fa-github"></i>
                                </button>
                            </div>

                            <p class="text-center text-light">or :</p>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="registerEmail" class="form-control" name="Email"/>
                                <label class="form-label text-light" for="registerEmail">Email</label>
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerUsername" class="form-control" name="UserRegister"/>
                                <label class="form-label text-light" for="registerUsername">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerPassword" class="form-control" name="PwdRegister"/>
                                <label class="form-label text-light" for="registerPassword">Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerRepeatPassword" class="form-control" name="PwdCheckRegister"/>
                                <label class="form-label text-light" for="registerRepeatPassword">Repeat password</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                                aria-describedby="registerCheckHelpText" />
                                <label class="form-check-label text-light" for="registerCheck">
                                I have read and agree to the terms
                                </label>
                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit-register"  class="btn btn-primary btn-block mb-3">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>