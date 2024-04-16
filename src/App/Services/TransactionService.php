<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use \DateTime;

class TransactionService
{
    public function __construct(private Database $db)
    {
    }

    public function getCurrentExpenseCategoryId(array $formData)
    {
        $expenseCategoryId = $this->db->query(
            "SELECT id FROM expenses_category_assigned_to_users 
             WHERE user_id = :userId AND name = :expenseCategory",
            [
                'userId' => $_SESSION['user'],
                'expenseCategory' => $formData['category']
            ]
        )->count();
        return $expenseCategoryId;
    }

    public function getCurrentPaymentMethodId(array $formData)
    {
        $paymentMethodId = $this->db->query(
            "SELECT id FROM payment_methods_assigned_to_users  
              WHERE user_id = :userId AND name = :paymentMethod",
            [
                'userId' => $_SESSION['user'],
                'paymentMethod' => $formData['paymentMethod']
            ]
        )->count();
        return $paymentMethodId;
    }

    public function createExpense(array $formData)
    {
        $idExpenseCategory = self::getCurrentExpenseCategoryId($formData);

        $idPaymentMethod = self::getCurrentPaymentMethodId($formData);

        $this->db->query(
            "INSERT INTO expenses(user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount,date_of_expense, expense_comment)
             VALUES(:user_id, :idExpenseCategory, :idPaymentMethod, :expenseSum, :expenseDate, :comment)",
            [
                'user_id' => $_SESSION['user'],
                'idExpenseCategory' => $idExpenseCategory,
                'idPaymentMethod' =>  $idPaymentMethod,
                'expenseSum' => $formData['amount'],
                'expenseDate' => $formData['date'],
                'comment' => $formData['description'],
            ]
        );

        $_SESSION['successfulAddedExpense'] = true;
    }

    public function getCurrentIncomeCategoryId(array $formData)
    {
        $incomeCategoryId = $this->db->query(
            "SELECT id FROM incomes_category_assigned_to_users 
             WHERE user_id = :userId AND name = :incomeCategory",
            [
                'userId' => $_SESSION['user'],
                'incomeCategory' => $formData['sourceOfIncome']
            ]
        )->count();
        return $incomeCategoryId;
    }

    public function createIncome(array $formData)
    {
        $incomeCategoryId = self::getCurrentIncomeCategoryId($formData);

        $this->db->query(
            "INSERT INTO incomes(user_id, income_category_assigned_to_user_id, amount, date_of_income,income_comment)
             VALUES(:user_id, :idIncomeCategory, :incomeSum, :incomeDate, :comment)",
            [
                'user_id' => $_SESSION['user'],
                'idIncomeCategory' => $incomeCategoryId,
                'incomeSum' => $formData['amount'],
                'incomeDate' => $formData['date'],
                'comment' => $formData['description'],
            ]
        );
        $_SESSION['successfulAddedIncome'] = true;
    }

    public function getBalanceStartAndEndDate(array $formData)
    {
        $selectedInterval = $formData['formBalanceData'];

        if ($selectedInterval == "currentMonth") {
            $currentMonth = date('m');
            $currentYear = date('Y');
            $startDate = date('Y-m-01', strtotime($currentYear . '-' . $currentMonth . '-01'));
            $endDate = date('Y-m-t', strtotime($currentYear . '-' . $currentMonth . '-01'));
        } else if ($selectedInterval == "previousMonth") {
            $firstDayPrevMonth = new DateTime('first day of last month');
            $startDate = $firstDayPrevMonth->format('Y-m-d');
            $lastDayPrevMonth = new DateTime('last day of last month');
            $endDate = $lastDayPrevMonth->format('Y-m-d');
        } else {
            $startDate = $formData['fromDate'];
            $endDate = $formData['toDate'];
        }

        $dates = [
            "start" => $startDate,
            "end" => $endDate
        ];

        return $dates;
    }

    public function getTotalIncome(array $formData)
    {
        $dates = self::getBalanceStartAndEndDate($formData);

        $queryResult = $this->db->query(
            "SELECT SUM(amount) AS totalIncomes FROM incomes 
                WHERE user_id = :userId AND date_of_income  BETWEEN :startDate AND :endDate LIMIT 1",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $dates['start'],
                'endDate' => $dates['end']
            ]
        )->findAll();

        $_SESSION['totalIncomes'] = $queryResult[0]['totalIncomes'];
    }

    public function getTotalExpense(array $formData)
    {
        $dates = self::getBalanceStartAndEndDate($formData);

        $queryResult = $this->db->query(
            "SELECT SUM(amount) AS totalExpenses FROM expenses   
                WHERE user_id = :userId AND date_of_expense BETWEEN :startDate AND :endDate LIMIT 1",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $dates['start'],
                'endDate' => $dates['end']
            ]
        )->findAll();

        $_SESSION['totalExpense'] = $queryResult[0]['totalExpenses'];
    }

    public function getListWithIncomes(array $formData)
    {
        $dates = self::getBalanceStartAndEndDate($formData);

        $_SESSION['incomesList'] = $this->db->query(
            "SELECT incomes_category_assigned_to_users.name AS category, 
             SUM(incomes.amount) AS amount
             FROM incomes_category_assigned_to_users
             INNER JOIN incomes ON incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id WHERE incomes.user_id = :userId AND incomes.date_of_income  
             BETWEEN :startDate AND :endDate
             GROUP BY incomes.income_category_assigned_to_user_id ORDER BY amount DESC",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $dates['start'],
                'endDate' => $dates['end']
            ]
        )->findAll();
    }

    public function getListWithExpenses(array $formData)
    {
        $dates = self::getBalanceStartAndEndDate($formData);

        $_SESSION['expensesList'] = $this->db->query(
            "SELECT expenses_category_assigned_to_users.name AS category, 
             SUM(expenses.amount) AS amount
             FROM expenses_category_assigned_to_users 
             INNER JOIN expenses  ON expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id WHERE expenses.user_id = :userId AND expenses.date_of_expense  
             BETWEEN :startDate AND :endDate
             GROUP BY expenses.expense_category_assigned_to_user_id ORDER BY amount DESC",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $dates['start'],
                'endDate' => $dates['end']
            ]
        )->findAll();
    }

    public function startFunction()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $startDate = date('Y-m-01', strtotime($currentYear . '-' . $currentMonth . '-01'));
        $endDate = date('Y-m-t', strtotime($currentYear . '-' . $currentMonth . '-01'));

        $queryResult = $this->db->query(
            "SELECT SUM(amount) AS totalIncomes FROM incomes 
                WHERE user_id = :userId AND date_of_income  BETWEEN :startDate AND :endDate LIMIT 1",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        )->findAll();

        $_SESSION['totalIncomes'] = $queryResult[0]['totalIncomes'];

        $queryResult = $this->db->query(
            "SELECT SUM(amount) AS totalExpenses FROM expenses   
                WHERE user_id = :userId AND date_of_expense BETWEEN :startDate AND :endDate LIMIT 1",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        )->findAll();

        $_SESSION['totalExpense'] = $queryResult[0]['totalExpenses'];


        $_SESSION['incomesList'] = $this->db->query(
            "SELECT incomes_category_assigned_to_users.name AS category, 
             SUM(incomes.amount) AS amount
             FROM incomes_category_assigned_to_users
             INNER JOIN incomes ON incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id WHERE incomes.user_id = :userId AND incomes.date_of_income  
             BETWEEN :startDate AND :endDate
             GROUP BY incomes.income_category_assigned_to_user_id ORDER BY amount DESC",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        )->findAll();

        $_SESSION['expensesList'] = $this->db->query(
            "SELECT expenses_category_assigned_to_users.name AS category, 
             SUM(expenses.amount) AS amount
             FROM expenses_category_assigned_to_users 
             INNER JOIN expenses  ON expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id WHERE expenses.user_id = :userId AND expenses.date_of_expense  
             BETWEEN :startDate AND :endDate
             GROUP BY expenses.expense_category_assigned_to_user_id ORDER BY amount DESC",
            [
                'userId' => $_SESSION['user'],
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        )->findAll();
    }
}
