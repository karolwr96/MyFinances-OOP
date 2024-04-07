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

        //get user id
        $_SESSION['user'] = $this->db->id();
        $id = $_SESSION['user'];

        //adding default incomes category to user
        $this->db->query(
            " INSERT INTO incomes_category_assigned_to_users (user_id, name) 
              SELECT '$id', name 
              FROM incomes_category_default"
        );

        //adding default expenses category to user
        $this->db->query(
            " INSERT INTO expenses_category_assigned_to_users (user_id, name) 
              SELECT '$id', name 
              FROM expenses_category_default"
        );

        //adding payment methods to user
        $this->db->query(
            " INSERT INTO payment_methods_assigned_to_users (user_id, name) 
              SELECT '$id', name 
              FROM payment_methods_default"
        );

        session_regenerate_id();
        //$_SESSION['user'] = $this->db->id();
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

        // get expenses categories

        $_SESSION['expensesCategories'] = $this->db->query(
            "SELECT * 
             FROM expenses_category_assigned_to_users 
             WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();

        //get payment methods

        $_SESSION['payMethods'] = $this->db->query(
            "SELECT * 
        FROM payment_methods_assigned_to_users 
        WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();

        //get incomes categories 

        $_SESSION['incomesCategories'] = $this->db->query(
            "SELECT * 
             FROM incomes_category_assigned_to_users 
             WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();
    }

    public function logout()
    {
        //session_destroy();
        unset($_SESSION['user']);
        session_regenerate_id();
    }

    /* public function getUserExpenseCategory()
    {
        $_SESSION['user'] = $this->db->id();
        $id = $_SESSION['user'];

        
        $_SESSION['expensesCategories'] = $this->db->query(
            "SELECT * 
             FROM expenses_category_assigned_to_users 
             WHERE user_id = :userId",
            [
                'userId' => $user['id']
            ]
        )->findAll();
    }*/
}
