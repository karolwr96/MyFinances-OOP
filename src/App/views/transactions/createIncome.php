<?php include $this->resolve("partials/_header.php"); ?>

<section id="add-Revenue-menu">
    <form method="post">
        <?php include $this->resolve("partials/_csrf.php"); ?>
        <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 md-5" tabindex="-1" role="dialog" id="modalSheet">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="gradient-custom-2 modal-header border-bottom-0" style="color: white">
                        <h1 class="modal-title fs-5">Adding new income</h1>
                    </div>

                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-4 border-top-0"></div>
                    <div class="container">
                        <div class="col pb-3">

                            <h6 class="px-2">Amount of income</h6>
                            <input value="<?php echo e($oldFormData['amount'] ?? ''); ?>" name="amount" type="number" step="0.01" class="form-control">
                        </div>
                        <?php if (array_key_exists('amount', $errors)) : ?>
                            <div class="error">
                                <?php echo e($errors['amount'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <h6 class="px-2">Income date</h6>
                        <div class="col pb-3">
                            <input value="<?php echo e($oldFormData['date'] ?? '');
                                            ?>" name="date" type="date" class="form-control">
                        </div>
                        <?php if (array_key_exists('date', $errors)) : ?>
                            <div class="error">
                                <?php echo e($errors['date'][0]);
                                ?>
                            </div>
                        <?php endif; ?>

                        <h6 class="px-2">Source of income</h6>
                        <div class="pb-3">
                            <select class="form-select" name="sourceOfIncome" aria-label="Default select example" value="">
                                <?php
                                $rows = $_SESSION['incomesCategories'];
                                foreach ($rows as $row) {
                                ?>
                                    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php if (array_key_exists('sourceOfIncome', $errors)) : ?>
                            <div class="error">
                                <?php echo e($errors['sourceOfIncome'][0]); ?>
                            </div>
                        <?php endif; ?>

                        <h6 class="px-2">Comment (optional)</h6>
                        <div class="col pb-4">
                            <input value="<?php echo e($oldFormData['description'] ?? ''); ?>" , name="description" type="text" class="form-control">
                        </div>
                        <?php if (array_key_exists('description', $errors)) : ?>
                            <div class="error">
                                <?php echo e($errors['description'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary mb-3" style="background-color: #ee7724; width: 40%">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z" />
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                            </svg>
                            Add income
                        </button>
                    </div>

                    <div class="text-center pb-4">
                        <a href="./logged.php" class="btn btn-lg btn-secondary mb-2" style="width: 40%">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                            Close
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>