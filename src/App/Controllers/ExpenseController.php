<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService, UserService};

class ExpenseController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TransactionService $transactionService,
        private UserService $userService,
    ) {
    }

    public function createView()
    {
        $userExpenseCategory = $this->userService->getUserExpenseCategory();
        $userPaymentMethods = $this->userService->getUserPaymentMethods();

        echo $this->view->render(
            "transactions/createExpense.php",
            [
                'rows' => $userExpenseCategory,
                'payment' => $userPaymentMethods
            ]
        );
    }

    public function create()
    {
        $this->validatorService->validateTransaction($_POST);

        $this->transactionService->createExpense($_POST);

        redirectTo('/expense');
    }
}
