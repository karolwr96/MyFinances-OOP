<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Services\TransactionService;


class SettingsService
{
    public function __construct(private Database $db)
    {
    }

    public function isIncomesCategoryTakenChangingName(string $editField)
    {
        $incomesCategoryCount =  $this->db->query(
            "SELECT COUNT(*) FROM incomes_category_assigned_to_users WHERE name =:editField AND user_id =:userId ",
            [
                'editField' => $editField,
                'userId' => $_SESSION['user']
            ]
        )->count();

        if ($incomesCategoryCount > 0) {
            throw new ValidationException(['editField' => ['Category name already exists']]);
        }
    }

    public function isIncomesCategoryTakenNewCategory(string $newField)
    {
        $incomesCategoryCount =  $this->db->query(
            "SELECT COUNT(*) FROM incomes_category_assigned_to_users WHERE name =:newSourceOfIncome AND user_id =:userId ",
            [
                'newSourceOfIncome' => $newField,
                'userId' => $_SESSION['user']
            ]
        )->count();

        if ($incomesCategoryCount > 0) {
            throw new ValidationException(['newSourceOfIncome' => ['Category name already exists']]);
        }
    }

    public function isExpenseCategoryTakenChangingName(string $editField)
    {
        $expensesCategoryCount =  $this->db->query(
            "SELECT COUNT(*) FROM expenses_category_assigned_to_users WHERE name =:editExpense AND user_id =:userId ",
            [
                'editExpense' => $editField,
                'userId' => $_SESSION['user']
            ]
        )->count();

        if ($expensesCategoryCount > 0) {
            throw new ValidationException(['editExpense' => ['Category name already exists']]);
        }
    }

    public function isExpenseCategoryTakenNewCategory(string $newField)
    {
        $expensesCategoryCount =  $this->db->query(
            "SELECT COUNT(*) FROM expenses_category_assigned_to_users WHERE name =:newExpenseCategory AND user_id =:userId ",
            [
                'newExpenseCategory' => $newField,
                'userId' => $_SESSION['user']
            ]
        )->count();

        if ($expensesCategoryCount > 0) {
            throw new ValidationException(['newExpenseCategory' => ['Category name already exists']]);
        }
    }

    public function isPaymentMethodTakenChangingName(string $editField)
    {
        $paymentMethodsCount =  $this->db->query(
            "SELECT COUNT(*) FROM payment_methods_assigned_to_users WHERE name =:newPaymentName AND user_id =:userId ",
            [
                'newPaymentName' => $editField,
                'userId' => $_SESSION['user']
            ]
        )->count();

        if ($paymentMethodsCount > 0) {
            throw new ValidationException(['newPaymentName' => ['Category name already exists']]);
        }
    }

    public function isPaymentMethodTakenNewCategory(string $editField)
    {
        $paymentMethodsCount =  $this->db->query(
            "SELECT COUNT(*) FROM payment_methods_assigned_to_users WHERE name =:newPaymentMethod AND user_id =:userId ",
            [
                'newPaymentMethod' => $editField,
                'userId' => $_SESSION['user']
            ]
        )->count();

        if ($paymentMethodsCount > 0) {
            throw new ValidationException(['newPaymentMethod' => ['Category name already exists']]);
        }
    }

    public function editIncomesCategoryName(array $formData)
    {
        $this->db->query(
            "UPDATE `incomes_category_assigned_to_users` SET `name` = :newName WHERE user_id = :userId AND name = :incomeCategory",
            [
                'userId' => $_SESSION['user'],
                'incomeCategory' => $formData['sourceOfIncome'],
                'newName' => $formData['editField'],
            ]
        );

        $_SESSION['successfulEditIncomesCategoryName'] = 'Category renamed successfully!';
    }

    public function editExpenseCategoryName(array $formData)
    {
        $this->db->query(
            "UPDATE `expenses_category_assigned_to_users` SET `name` = :newName WHERE user_id = :userId AND name = :expenseCategory",
            [
                'userId' => $_SESSION['user'],
                'expenseCategory' => $formData['category'],
                'newName' => $formData['editExpense'],
            ]
        );
        $_SESSION['successfulEditExpenseCategoryName'] = 'Category renamed successfully!';
    }

    public function editPaymentMethodName(array $formData)
    {
        $this->db->query(
            "UPDATE `payment_methods_assigned_to_users` SET `name` = :newName WHERE user_id = :userId AND name = :paymentMethod",
            [
                'userId' => $_SESSION['user'],
                'paymentMethod' => $formData['paymentMethod'],
                'newName' => $formData['newPaymentName'],
            ]
        );
        $_SESSION['successfulEditPaymentMethodName'] = 'Category renamed successfully!';
    }

    public function addNewIncomesCategory(array $formData)
    {
        $this->db->query(
            "INSERT INTO `incomes_category_assigned_to_users` (user_id, name) VALUES (:userId, :newSourceOfIncome)",
            [
                'userId' => $_SESSION['user'],
                'newSourceOfIncome' => $formData['newSourceOfIncome']
            ]
        );
        $_SESSION['successfulAddedNewIncomesCategory'] = 'New category added successfully!';
    }

    public function addNewExpenseCategory(array $formData)
    {
        $this->db->query(
            "INSERT INTO `expenses_category_assigned_to_users` (user_id, name) VALUES (:userId, :newExpenseCategory)",
            [
                'userId' => $_SESSION['user'],
                'newExpenseCategory' => $formData['newExpenseCategory']
            ]
        );
        $_SESSION['successfulAddedNewExpenseCategory'] = 'New category added successfully!';
    }

    public function addNewPaymentMethod(array $formData)
    {
        $this->db->query(
            "INSERT INTO `payment_methods_assigned_to_users` (user_id, name) VALUES (:userId, :newPaymentMethod)",
            [
                'userId' => $_SESSION['user'],
                'newPaymentMethod' => $formData['newPaymentMethod']
            ]
        );
        $_SESSION['successfulAddedNewPaymentMethod'] = 'New category added successfully!';
    }

    public function deleteSourceOfIncome(array $formData)
    {
        $incomeCategoryId = $this->db->query(
            "SELECT id FROM incomes_category_assigned_to_users 
             WHERE user_id = :userId AND name = :incomeCategory",
            [
                'userId' => $_SESSION['user'],
                'incomeCategory' => $formData['sourceOfIncome']
            ]
        )->count();

        $this->db->query(
            "DELETE FROM `incomes_category_assigned_to_users` WHERE user_id = :userId AND name = :incomeCategory",
            [
                'userId' => $_SESSION['user'],
                'incomeCategory' => $formData['sourceOfIncome'],
            ]
        );

        $_SESSION['idCat'] = $incomeCategoryId;

        $this->db->query(
            "DELETE FROM `incomes` WHERE user_id = :userId AND income_category_assigned_to_user_id = :incomeCategoryId",
            [
                'userId' => $_SESSION['user'],
                'incomeCategoryId' => $incomeCategoryId
            ]
        );
        $_SESSION['successfulDeletedSourceOfIncome'] = 'Category deleted successfully!';
    }

    public function deleteExpenseCategory(array $formData)
    {
        $expenseCategoryId = $this->db->query(
            "SELECT id FROM expenses_category_assigned_to_users 
             WHERE user_id = :userId AND name = :expenseCategory",
            [
                'userId' => $_SESSION['user'],
                'expenseCategory' => $formData['category']
            ]
        )->count();

        $this->db->query(
            "DELETE FROM `expenses_category_assigned_to_users` WHERE user_id = :userId AND name = :expenseCategory",
            [
                'userId' => $_SESSION['user'],
                'expenseCategory' => $formData['expenseCategory'],
            ]
        );

        $_SESSION['idCat1'] = $expenseCategoryId;

        $this->db->query(
            "DELETE FROM `expenses` WHERE user_id = :userId AND expense_category_assigned_to_user_id = :expenseCategoryId",
            [
                'userId' => $_SESSION['user'],
                'expenseCategoryId' => $expenseCategoryId
            ]
        );
        $_SESSION['successfulDeletedExpenseCategory'] = 'Category deleted successfully!';
    }

    public function deletePaymentMethod(array $formData)
    {
        $paymentMethodId = $this->db->query(
            "SELECT id FROM payment_methods_assigned_to_users 
             WHERE user_id = :userId AND name = :paymentMethod",
            [
                'userId' => $_SESSION['user'],
                'paymentMethod' => $formData['paymentMethod']
            ]
        )->count();

        $this->db->query(
            "DELETE FROM `payment_methods_assigned_to_users` WHERE user_id = :userId AND name = :paymentMethod",
            [
                'userId' => $_SESSION['user'],
                'paymentMethod' => $formData['paymentMethod'],
            ]
        );
        $_SESSION['successfulDeletedPaymentMethod'] = 'Category deleted successfully!';
    }
}
