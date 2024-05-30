<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;


class SettingsService
{
    public function editFieldName(array $formData)
    {
        /* $emailCount =  $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email =:email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ['Email taken']]);
        }*/
    }
}
