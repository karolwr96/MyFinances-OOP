<?php include $this->resolve("partials/_header.php"); ?>

<section id="balance-sheet">
    <div class="container col-lg-4 p-4 md-5">
        <div class="shadow">
            <div class="gradient-custom-2" style="
              color: white;
              height: 55px;
              border-radius: 0.3rem;
              display: flex;
              align-items: center;
            ">
                <h4 class="px-3">Your balance sheet</h4>
            </div>
            <div class="container mt-3">
                <div class="row g-0 mb-5">
                    <h6 class="px-2">Select date range</h6>
                    <form method="post">
                        <?php include $this->resolve("partials/_csrf.php"); ?>
                        <div class="pb-3">
                            <select id="options" class="form-select" name="formBalanceData" aria-label="Default select example" onchange="toggleFields()">
                                <option value="currentMonth">Current month</option>
                                <option value="previousMonth">Previous month</option>
                                <option value="individualInterval">Own scope</option>
                            </select>
                            <br>
                            <div id="fields">
                                <h6 class="px-2">From:</h6>
                                <input type="date" id="fromDate" name="fromDate" class="form-control">
                                <br>
                                <h6 class="px-2">To:</h6>
                                <input type="date" id="toDate" name="toDate" class="form-control">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary mb-3" style="background-color: #ee7724; width: 40%">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1" />
                                </svg>
                                Show
                            </button>
                        </div>
                    </form>

                    <div class="pb-3">
                        <table class="table">
                            <thead>

                                <tr>
                                    <th>Category</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['incomesList'])) {
                                    $arrayWithResult = $_SESSION['incomesList'];


                                    foreach ($arrayWithResult as $row) {
                                        echo "<tr>
                    <td>{$row['category']}</td>
                    <td>{$row['amount']}</td>
                    </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="my-3">
                            <h5 class="px-3" style="text-align: center;">Total incomes: <?php if (!isset($_SESSION['totalIncomes'])) {
                                                                                            echo '0';
                                                                                        } else {
                                                                                            echo ($_SESSION['totalIncomes']);
                                                                                        } ?></h5>
                        </div>

                        <div>
                            <canvas id="incomesChart"></canvas>
                        </div>

                        <table class="table">
                            <thead>

                                <tr>
                                    <th>Category</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['expensesList'])) {
                                    $arrayWithExpenses = $_SESSION['expensesList'];
                                    foreach ($arrayWithExpenses as $newRow) {
                                        echo "<tr>
                    <td>{$newRow['category']}</td>
                    <td>{$newRow['amount']}</td>
                    </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>


                        <div class="my-3">
                            <h5 class="px-3" style="text-align: center;">Total expenses: <?php if (!isset($_SESSION['totalExpense'])) {
                                                                                                echo '0';
                                                                                            } else {
                                                                                                echo ($_SESSION['totalExpense']);
                                                                                            } ?>
                            </h5>
                        </div>


                        <div id="chartContainer">
                            <canvas id="expenseChart"></canvas>
                        </div>

                        <div class="my-3">
                            <h5 class="px-3" style="text-align: center;">Your balance is: <?php
                                                                                            $incomes = 0;
                                                                                            $expenses = 0;
                                                                                            if (isset($_SESSION['totalExpense'])) {
                                                                                                $expenses = $_SESSION['totalExpense'];
                                                                                            }

                                                                                            if (isset($_SESSION['totalIncomes'])) {
                                                                                                $incomes = $_SESSION['totalIncomes'];
                                                                                            }
                                                                                            $total = $incomes - $expenses;
                                                                                            echo $total;
                                                                                            ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<script>
    const selectedOption = localStorage.getItem('selectedOption');
    if (selectedOption) {
        document.getElementById('options').value = selectedOption;
    }

    document.getElementById('options').addEventListener('change', function() {
        localStorage.setItem('selectedOption', this.value);
        toggleFields();
    });

    function toggleFields() {
        const selectedOption = document.getElementById('options').value;
        const fieldsContainer = document.getElementById('fields');
        const fromDateInput = fieldsContainer.querySelector('input[name="fromDate"]');
        const toDateInput = fieldsContainer.querySelector('input[name="toDate"]');

        if (selectedOption === 'currentMonth') {
            const currentDate = new Date();
            const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            fromDateInput.value = formatDate(firstDayOfMonth);
            toDateInput.value = formatDate(lastDayOfMonth);

        } else if (selectedOption === 'previousMonth') {
            const currentDate = new Date();
            const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
            const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0);
            fromDateInput.value = formatDate(firstDayOfMonth);
            toDateInput.value = formatDate(lastDayOfMonth);

        } else {
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', () => {
                    localStorage.setItem(input.id, input.value);
                });
            });

            window.addEventListener('load', () => {
                document.querySelectorAll('input').forEach(input => {
                    const storedValue = localStorage.getItem(input.id);
                    if (storedValue) {
                        input.value = storedValue;
                    }
                });
            });
        }
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    toggleFields();
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const incomesTable = <?php echo json_encode($arrayWithResult); ?>;
    const expenseTable = <?php echo json_encode($arrayWithExpenses); ?>;
</script>

<script src="/assets/scripts/incomesChart.js"> </script>
<script src="/assets/scripts/expensesChart.js"> </script>

</body>

</html>