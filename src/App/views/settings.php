<?php include $this->resolve("partials/_header.php"); ?>

<section id="add-Revenue-menu">
    <form method="post">
        <?php include $this->resolve("partials/_csrf.php"); ?>
        <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 md-5" tabindex="-1" role="dialog" id="modalSheet">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="gradient-custom-2 modal-header border-bottom-0" style="color: white">
                        <h1 class="modal-title fs-5">Settings</h1>
                    </div>

                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-4 border-top-0"></div>
                    <div class="container">

                        <h6 class="px-2">Change category name: </h6>

                        <h6 class="px-2">Sources of incomes</h6>
                        <div class="pb-3">
                            <select class="form-select" name="sourceOfIncome" aria-label="Default select example" value="">
                                <?php
                                foreach ($incomeSources as $row) {
                                ?>
                                    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="text" name="editField" placeholder="Edit Field">
                            <button type="submit" name="applyButton">Apply</button>
                        </div>

                        <h6 class="px-2">Expense categories</h6>
                        <div class="pb-3">
                            <select class="form-select" name="category" aria-label="Default select example" value="">
                                <?php
                                foreach ($rows as $row) {
                                ?>
                                    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <h6 class="px-2"> Payment method</h6>
                        <div class="pb-3">
                            <select class="form-select" name="paymentMethod" aria-label="Default select example" value="">
                                <?php
                                //$rowsWithPayment = $_SESSION['payMethods'];
                                foreach ($payment as $row) {
                                ?>
                                    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>


                        <div class="text-center pb-4">
                            <a href="/" class="btn btn-lg btn-secondary mb-2" style="width: 40%">
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