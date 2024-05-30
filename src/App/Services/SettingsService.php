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

    public function editFieldName(array $formData)
    {
        //$categoryToChangeName => $formData['amount'],
        // $newCategoryToChangeName => $formData['editField'];

        $this->db->query(
            "UPDATE `incomes_category_assigned_to_users` SET `name` = :newName WHERE user_id = :userId AND name = :incomeCategory",
            [
                'userId' => $_SESSION['user'],
                'incomeCategory' => $formData['sourceOfIncome'],
                'newName' => $formData['editField'],
            ]
        );
        // SET name = 'TEST123' 
        //WHERE name = 'Wyplata' AND user_id = 13;    

        /* $emailCount =  $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email =:email",
            [
                'email' => $email
            ]
        )->count();
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

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ['Email taken']]);
        }*/
    }
}
