<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;


class SettingsService
{
    public function __construct(private Database $db)
    {
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
    }
}
