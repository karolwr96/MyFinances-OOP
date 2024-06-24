<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{UserService, SettingsService};

class SettingsController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private SettingsService $settingsService
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

    public function editField()
    {
        if (array_key_exists('editSourcesOfIncomes', $_POST)) {
            $this->settingsService->editIncomesCategoryName($_POST);
        }
        if (array_key_exists('editExpenseCategory', $_POST)) {
            $this->settingsService->editExpenseCategoryName($_POST);
        }
        if (array_key_exists('editPaymentMethod', $_POST)) {
            $this->settingsService->editPaymentMethodName($_POST);
        }

        if (array_key_exists('addNewSourcesOfIncomes', $_POST)) {
            $this->settingsService->addNewIncomesCategory($_POST);
        }

        if (array_key_exists('addNewExpenseCategory', $_POST)) {
            $this->settingsService->addNewExpenseCategory($_POST);
        }

        if (array_key_exists('addNewPaymentMethod', $_POST)) {
            $this->settingsService->addNewPaymentMethod($_POST);
        }

        if (array_key_exists('deleteSourceOfIncome', $_POST)) {
            $this->settingsService->deleteSourceOfIncome($_POST);
        }

        redirectTo('/settings');
    }
}
