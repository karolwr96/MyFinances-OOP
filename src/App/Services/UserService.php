<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db)
    {
    }

    public function isEmailTaken(string $email)
    {
        $emailCount =  $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email =:email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ['Email taken']]);
        }
    }

    public function create(array $formData)
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "INSERT INTO users (userName, password, email)
           VALUES (:userName, :password, :email)",
            [
                'userName' => $formData['userName'],
                'password' => $password,
                'email' => $formData['email']
            ]
        );
        session_regenerate_id();
    }

    public function addDefaultValuesToUser(array $formData)
    {
        //get user id
        $_SESSION['user'] = $this->db->id();
        $id = $_SESSION['user'];

        $this->db->query(
            " INSERT INTO incomes_category_assigned_to_users (user_id, name) 
              SELECT '$id', name 
              FROM incomes_category_default"
        );

        $this->db->query(
            " INSERT INTO expenses_category_assigned_to_users (user_id, name) 
              SELECT '$id', name 
              FROM expenses_category_default"
        );

        $this->db->query(
            " INSERT INTO payment_methods_assigned_to_users (user_id, name) 
              SELECT '$id', name 
              FROM payment_methods_default"
        );
        session_regenerate_id();
    }

    public function login(array $formData)
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']
        ])->find();

        $passwordsMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Invalid credentials']]);
        }

        $_SESSION['user'] = $user['id'];

        session_regenerate_id();
    }

    public function getUserIncomeSource()
    {
        $user['id'] = $_SESSION['user'];

        $incomesSource = $this->db->query(
            "SELECT * 
             FROM incomes_category_assigned_to_users 
             WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();

        return $incomesSource;
    }

    public function getUserExpenseCategory()
    {
        $user['id'] = $_SESSION['user'];

        $expenseCategories = $this->db->query(
            "SELECT * 
             FROM expenses_category_assigned_to_users 
             WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();

        return $expenseCategories;
    }

    public function getUserPaymentMethods()
    {
        $user['id'] = $_SESSION['user'];

        $paymentMethods = $this->db->query(
            "SELECT * 
             FROM payment_methods_assigned_to_users 
             WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();

        return $paymentMethods;
    }

    public function logout()
    {
        session_destroy();

        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    public function changeUserPassword(array $formData)
    {
        $password = password_hash($formData['newpassword'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "UPDATE users SET password = :newPassword
            WHERE id = :userId",
            [
                'userId' => $_SESSION['user'],
                'newPassword' => $password
            ]

        );

        session_regenerate_id();

        $_SESSION['successfulChangedPassword'] = 'Password changed successfully!';
    }

    public function deleteUserAccount()
    {
        $this->db->query(
            "DELETE FROM `expenses` WHERE user_id = :userId",
            [
                'userId' => $_SESSION['user'],
            ]
        );

        $this->db->query(
            "DELETE FROM `expenses_category_assigned_to_users` WHERE user_id = :userId",
            [
                'userId' => $_SESSION['user'],
            ]
        );

        $this->db->query(
            "DELETE FROM `incomes` WHERE user_id = :userId",
            [
                'userId' => $_SESSION['user'],
            ]
        );

        $this->db->query(
            "DELETE FROM `incomes_category_assigned_to_users` WHERE user_id = :userId",
            [
                'userId' => $_SESSION['user'],
            ]
        );

        $this->db->query(
            "DELETE FROM `payment_methods_assigned_to_users` WHERE user_id = :userId",
            [
                'userId' => $_SESSION['user'],
            ]
        );

        $this->db->query(
            "DELETE FROM `users` WHERE id = :userId",
            [
                'userId' => $_SESSION['user'],
            ]
        );
    }
}
