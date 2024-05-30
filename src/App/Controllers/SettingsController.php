<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService, UserService, SettingService};

class SettingsController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
    ) {
    }

    public function createView()
    {
        $incomesCategories = $this->userService->getUserIncomeSource();
        $userExpenseCategory = $this->userService->getUserExpenseCategory();
        $userPaymentMethods = $this->userService->getUserPaymentMethods();

        echo $this->view->render(
            "/settings.php",
            [
                'incomeSources' => $incomesCategories,
                'rows' => $userExpenseCategory,
                'payment' => $userPaymentMethods
            ]
        );
    }
}
