<?php include $this->resolve("partials/_header.php"); ?>

<section class="h-100" style="background-color: #eee;">
    <div class="container py-0 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <section id="add-Revenue-menu">
                    <form method="post">
                        <?php include $this->resolve("partials/_csrf.php"); ?>
                        <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 md-5" tabindex="-1" role="dialog" id="modalSheet">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content rounded-4 shadow">
                                    <div class="gradient-custom-2 modal-header border-bottom-0" style="color: white">
                                        <h1 class="modal-title fs-5">Account settings</h1>
                                    </div>

                                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-4 border-top-0"></div>
                                    <div class="container">

                                        <h6 class="px-2">Change password: </h6>
                                        <div class="form-outline mb-2">
                                            <input type="password" value="" name="password" id="form3Example4" class="form-control" />
                                            <label class="form-label" for="form3Example4">1. New password</label>
                                            <?php if (array_key_exists('password', $errors)) : ?>
                                                <div class="error">
                                                    <?php echo e($errors['password'][0]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-outline mb-2">
                                            <input type="password" value="" name="confirmPassword" id="form3Example4" class="form-control" />
                                            <label class="form-label" for="form3Example4">2. Confirm new password</label>
                                            <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                                                <div class="error">
                                                    <?php echo e($errors['confirmPassword'][0]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="text-center pb-4">
                                            <a href="/" class="btn btn-lg btn-primary mb-2" style="width: 40%; background-color: #ee7724">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                                </svg>
                                                Apply
                                            </a>
                                        </div>

                                        <hr>

                                        <h6 class="px-2">Delete account: </h6>
                                        <h6 class="px-2" style="color: red;">Using this option will permanently delete your account and all data associated with it. I confirm that I have read this information. </h6>

                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input class="form-check-input me-2" type="checkbox" name="regulations" id="form2Example33" <?php echo $oldFormData['regulations'] ?? false ? 'checked' : '' ?> />
                                            <label class="form-check-label" for="form2Example33">
                                                I have read the above information
                                            </label>
                                        </div>

                                        <div class="text-center pb-4">
                                            <a href="/" class="btn btn-lg btn-danger mb-2" style="width: 40%">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                                </svg>
                                                Delete account
                                            </a>
                                        </div>
                                    </div>
                                </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>