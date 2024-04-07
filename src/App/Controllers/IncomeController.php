<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService, UserService};

class IncomeController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TransactionService $transactionService
        //private UserService $userService
    ) {
    }

    public function createView()
    {
        echo $this->view->render("transactions/createIncome.php");
    }

    public function create()
    {
        $this->validatorService->validateIncome($_POST);

        $this->transactionService->createIncome($_POST);

        redirectTo('/');
    }
}
