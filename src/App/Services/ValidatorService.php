<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    InRule,
    UrlRule,
    MatchRule,
    LengthMaxRule,
    NumericRule,
    DateFormatRule
};

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('match', new MatchRule());
        $this->validator->add('lengthMax', new LengthMaxRule());
        $this->validator->add('numeric', new NumericRule());
        $this->validator->add('dateFormat', new DateFormatRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'userName' => ['required'],
            'email' => ['required',  'email'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'regulations' => ['required']
        ]);
    }

    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required',  'email'],
            'password' => ['required']
        ]);
    }

    public function validateTransaction(array $formData)
    {
        $this->validator->validate($formData, [
            'description' => ['lengthMax:100'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'dateFormat:Y-m-d'],
            'category' => ['required'],
            'paymentMethod' => ['required']

        ]);
    }

    public function validateIncome(array $formData)
    {
        $this->validator->validate($formData, [
            'description' => ['lengthMax:100'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'dateFormat:Y-m-d'],
            'sourceOfIncome' => ['required'],
        ]);
    }

    public function validateIncomesCategoryNewName(array $formData)
    {
        $this->validator->validate($formData, [
            'editField' => ['required']
        ]);
    }

    public function validateExpenseCategoryNewName(array $formData)
    {
        $this->validator->validate($formData, [
            'editExpense' => ['required']
        ]);
    }

    public function validatePaymentMethodNewName(array $formData)
    {
        $this->validator->validate($formData, [
            'newPaymentName' => ['required']
        ]);
    }

    public function validateNewIncomesCategory(array $formData)
    {
        $this->validator->validate($formData, [
            'newSourceOfIncome' => ['required']
        ]);
    }

    public function validateNewExpenseCategory(array $formData)
    {
        $this->validator->validate($formData, [
            'newExpenseCategory' => ['required']
        ]);
    }

    public function validateNewPaymentMethod(array $formData)
    {
        $this->validator->validate($formData, [
            'newPaymentMethod' => ['required']
        ]);
    }
}
