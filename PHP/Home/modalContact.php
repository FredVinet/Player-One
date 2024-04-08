<div class="modal fade " id="ContactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="radius-modal modal-content background-modal">
            <div class="modal-body">
                <!-- Header -->
                <div class="modal-header text-light d-flex justify-content-between">
                    <h5 class="modal-title" id="modifyModalLabel">Contact Us</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <img style="width:15px; height:20px;" src="./Assets/croixBlanche.png" alt="Cross">
                    </button>
                </div>
                <!-- Contact Form -->
                <form action="./index.php" method="POST">
                    <div class="text-center mb-3 text-light">
                        <p>Connect with us through :</p>
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

                    <p class="text-center text-light">or fill out this form :</p>

                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="contactName" class="form-control" name="Name"/>
                        <label class="form-label text-light" for="contactName">Name</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="contactEmail" class="form-control" name="Email"/>
                        <label class="form-label text-light" for="contactEmail">Email</label>
                    </div>

                    <!-- Subject input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="contactSubject" class="form-control" name="Subject"/>
                        <label class="form-label text-light" for="contactSubject">Subject</label>
                    </div>

                    <!-- Message input -->
                    <div class="form-outline mb-4">
                        <textarea class="form-control" id="contactMessage" rows="4" name="Message"></textarea>
                        <label class="form-label text-light" for="contactMessage">Message</label>
                    </div>

                    <!-- Submit button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit-contact" class="btn btn-primary btn-block mb-4">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
