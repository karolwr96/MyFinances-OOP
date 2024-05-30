<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
    HomeController,
    AuthController,
    ExpenseController,
    IncomeController,
    HowToUseController,
    ErrorController,
    SettingsController
};
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->post('/', [HomeController::class, 'showBalance'])->add(AuthRequiredMiddleware::class);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/expense', [ExpenseController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/expense', [ExpenseController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/income', [IncomeController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/income', [IncomeController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/howToUse', [HowToUseController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->get('/settings', [SettingsController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/settings', [SettingsController::class, 'editField'])->add(AuthRequiredMiddleware::class);
    $app->setErrorHandler([ErrorController::class, 'notFound']);
}
