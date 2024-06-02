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
                'newName' => $formData['newName'],
            ]
        );
    }
}
