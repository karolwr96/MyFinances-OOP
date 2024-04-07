<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{ValidatorService, TransactionService, UserService};

class HomeController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TransactionService $transactionService
        //private UserService $userService
    ) {
    }

    public function home()
    {
        echo $this->view->render(
            "/index.php",
            [
                'title' => 'Home Page',
                //'totalIncome' => '0',
                //'totalExpense' => '0'
            ]
        );
    }

    public function showBalance()
    {
        $totalIncome = $this->transactionService->getTotalIncome($_POST);
        $totalExpense = $this->transactionService->getTotalExpense($_POST);

        $this->transactionService->getListWithIncomes($_POST);
        $this->transactionService->getListWithExpenses($_POST);

        echo $this->view->render(
            "/index.php",
            [
                'totalIncome' => $totalIncome,
                'totalExpense' =>  $totalExpense
            ]
        );
        redirectTo('/');
    }
}
