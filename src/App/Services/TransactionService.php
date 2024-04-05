<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db)
    {
    }

    public function getCurrentCategoryId(array $formData)
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

    public function create(array $formData)
    {
        $idExpenseCategory = self::getCurrentCategoryId($formData);

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
    }
}
