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
                            <div id="fields" class="hidden">
                                <h6 class="px-2">From:</h6>
                                <input type="date" name="fromDate" class="form-control">
                                <br>
                                <h6 class="px-2">To:</h6>
                                <input type="date" name="toDate" class="form-control">
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
                                <h6 class="px-2">Total incomes: <?php if (!isset($_SESSION['totalIncomes'])) {
                                                                    echo '0';
                                                                } else {
                                                                    echo ($_SESSION['totalIncomes']);
                                                                } ?></h6>
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

                            <canvas id="pieChart"></canvas>

                        </table>

                        <table class="table">
                            <thead>
                                <h6 class="px-2">Total expenses: <?php if (!isset($_SESSION['totalExpense'])) {
                                                                        echo '0';
                                                                    } else {
                                                                        echo ($_SESSION['totalExpense']);
                                                                    } ?>
                                </h6>
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

                        <canvas id="pieChart"></canvas>

                        <div class="my-3">
                            <h5 class="px-3" style="text-align: center;">Your balance is: <?php
                                                                                            $incomes = 0;
                                                                                            $expenses = 0;
                                                                                            if (isset($_SESSION['totalExpense'])) {
                                                                                                $expenses = $_SESSION['totalExpense'];
                                                                                            }

                                                                                            if (isset($_SESSION['totalIncomes'])) {
                                                                                                $expenses = $_SESSION['totalExpense'];
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    function toggleFields() {
        const select = document.getElementById('options');
        const fields = document.getElementById('fields');

        if (select.value === 'individualInterval') {
            fields.classList.remove('hidden');
        } else {
            fields.classList.add('hidden');
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Get the table data
    const tableData = <?php echo json_encode($arrayWithResult); ?>;

    // Extract the category and amount from the table data
    const categories = tableData.map((row) => row.category);
    const amounts = tableData.map((row) => row.amount);

    // Create a new Chart instance
    const ctx = document.getElementById('pieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                data: amounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                ],
            }, ],
        },
        options: {
            responsive: true,
        },
    });
</script>

<script>
    // Get the table data
    const tableData = <?php echo json_encode($arrayWithExpenses); ?>;

    // Extract the category names and amounts from the table data
    const expenseCategories = tableData.map(row => row.category);
    const expenseAmounts = tableData.map(row => row.amount);

    // Create a new Chart instance
    const ctx2 = document.getElementById('pieChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: expenseCategories,
            datasets: [{
                data: expenseAmounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</body>

</html>