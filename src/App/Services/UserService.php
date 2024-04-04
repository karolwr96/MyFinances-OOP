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
    }
}
