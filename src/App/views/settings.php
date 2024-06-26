<?php include $this->resolve("partials/_header.php");
echo '<pre>';
var_dump($_SESSION);
echo '</pre>'; ?>

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

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(1)">1. Sources of incomes</h6>
                        <div id="div1" style="display: none;">
                            <select class="form-select" name="sourceOfIncome" aria-label="Default select example" value="">
                                <?php
                                foreach ($incomeSources as $row) {
                                ?>
                                    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class=" pt-3 pb-3 d-flex">
                                <input value="<?php echo e($oldFormData['editField'] ?? ''); ?>" style="width: 65%;" type="text" class="form-control  me-2" name="editField" placeholder="New name">
                                <button style="width: 35%; background-color: #ee7724" type="submit" class="btn btn-primary" name="editSourcesOfIncomes">Apply</button>
                            </div>
                            <?php if (array_key_exists('editField', $errors)) : ?>
                                <div class="error">
                                    <?php echo e($errors['editField'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(2)">2. Expense category</h6>
                        <div id="div2" style="display: none;">
                            <select class="form-select" name="category" aria-label="Default select example" value="">
                                <?php
                                foreach ($rows as $row) {
                                ?>
                                    <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class=" pt-3 pb-3 d-flex">
                                <input value="<?php echo e($oldFormData['editExpense'] ?? ''); ?>" style="width: 65%;" type="text" class="form-control  me-2" name="editExpense" placeholder="New name">
                                <button style="width: 35%; background-color: #ee7724" type="submit" class="btn btn-primary" name="editExpenseCategory">Apply</button>
                            </div>
                            <?php if (array_key_exists('editExpense', $errors)) : ?>
                                <div class="error">
                                    <?php echo e($errors['editExpense'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(3)">3. Payment method</h6>
                        <div id="div3" style="display: none;">
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
                            <div class=" pt-3 pb-3 d-flex">
                                <input value="<?php echo e($oldFormData['newPaymentName'] ?? ''); ?>" style="width: 65%;" type="text" class="form-control  me-2" name="newPaymentName" placeholder="New name">
                                <button style="width: 35%; background-color: #ee7724" type="submit" class="btn btn-primary" name="editPaymentMethod">Apply</button>
                            </div>
                            <?php if (array_key_exists('newPaymentName', $errors)) : ?>
                                <div class="error">
                                    <?php echo e($errors['newPaymentName'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <h6 class="px-2">Add another category: </h6>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(4)">4. New sources of incomes</h6>
                        <div id="div4" style="display: none;">
                            <div class=" pb-3 d-flex">
                                <input value="<?php echo e($oldFormData['newSourceOfIncome'] ?? ''); ?>" style="width: 65%;" type="text" class="form-control  me-2" name="newSourceOfIncome" placeholder="New sources of incomes">
                                <button style="width: 35%;" type="submit" class="btn btn-success" name="addNewSourcesOfIncomes">Add</button>
                            </div>
                            <?php if (array_key_exists('newSourceOfIncome', $errors)) : ?>
                                <div class="error">
                                    <?php echo e($errors['newSourceOfIncome'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(5)">5. New expense category</h6>
                        <div id="div5" style="display: none;">
                            <div class=" pb-3 d-flex">
                                <input value="<?php echo e($oldFormData['newExpenseCategory'] ?? ''); ?>" style="width: 65%;" type="text" class="form-control  me-2" name="newExpenseCategory" placeholder="New sources of incomes">
                                <button style="width: 35%;" type="submit" class="btn btn-success" name="addNewExpenseCategory">Add</button>
                            </div>
                            <?php if (array_key_exists('newExpenseCategory', $errors)) : ?>
                                <div class="error">
                                    <?php echo e($errors['newExpenseCategory'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(6)">6. New payment method</h6>
                        <div id="div6" style="display: none;">
                            <div class=" pb-3 d-flex">
                                <input value="<?php echo e($oldFormData['newPaymentMethod'] ?? ''); ?>" style="width: 65%;" type="text" class="form-control  me-2" name="newPaymentMethod" placeholder="New sources of incomes">
                                <button style="width: 35%;" type="submit" class="btn btn-success" name="addNewPaymentMethod">Add</button>
                            </div>
                            <?php if (array_key_exists('newPaymentMethod', $errors)) : ?>
                                <div class="error">
                                    <?php echo e($errors['newPaymentMethod'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <h6 class="px-2">Remove current category: </h6>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(7)">7. Delete source of income</h6>
                        <div id="div7" style="display: none;">
                            <div class=" pt-3 pb-3 d-flex">
                                <select class="form-select" name="sourceOfIncome" aria-label="Default select example" value="">
                                    <?php
                                    foreach ($incomeSources as $row) {
                                    ?>
                                        <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button style="width: 25%;" type="submit" class="btn btn-danger" name="deleteSourceOfIncome">Delete</button>
                            </div>
                        </div>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(8)">8. Delete expense category</h6>
                        <div id="div8" style="display: none;">
                            <div class=" pt-3 pb-3 d-flex">
                                <select class="form-select" name="expenseCategory" aria-label="Default select example" value="">
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button style="width: 25%;" type="submit" class="btn btn-danger" name="deleteExpenseCategory">Delete</button>
                            </div>
                        </div>

                        <h6 class="px-2 py-2" style=" cursor: pointer;" onclick="toggleDivVisibility(9)">9. Delete payment method</h6>
                        <div id="div9" style="display: none;">
                            <div class=" pt-3 pb-3 d-flex">
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
                                <button style="width: 25%;" type="submit" class="btn btn-danger" name="deletePaymentMethod">Delete</button>
                            </div>
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
    </form>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="/assets/scripts/toogleVisibility.js"> </script>
</body>

</html>