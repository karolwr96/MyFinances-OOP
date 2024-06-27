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
        //$incomesCategories = $this->userService->getUserIncomeSource();
        //$userExpenseCategory = $this->userService->getUserExpenseCategory();
        //$userPaymentMethods = $this->userService->getUserPaymentMethods();

        echo $this->view->render(
            "/account.php",
            [
                // 'incomeSources' => $incomesCategories,
                // 'rows' => $userExpenseCategory,
                // 'payment' => $userPaymentMethods
            ]
        );
    }
}
