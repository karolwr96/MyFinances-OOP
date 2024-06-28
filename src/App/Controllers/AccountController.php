<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{UserService, SettingsService, ValidatorService};

class AccountController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private SettingsService $settingsService,
        private ValidatorService $validatorService
    ) {
    }

    public function createView()
    {
        echo $this->view->render(
            "/account.php",
            []
        );
    }

    public function editField()
    {
        if (array_key_exists('changeUserPassword', $_POST)) {
            $this->validatorService->validateChangingPassword($_POST);
            $this->userService->changeUserPassword($_POST);
            redirectTo('/account');
        }

        if (array_key_exists('deleteUserAccount', $_POST)) {
            $this->validatorService->validateDeleteAccount($_POST);
            $this->userService->deleteUserAccount();
            $this->userService->logout();
            redirectTo('/login');
        }
    }
}
