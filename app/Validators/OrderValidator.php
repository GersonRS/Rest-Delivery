<?php

namespace Delivery\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class OrderValidator extends LaravelValidator
{

    protected $messages = [
        'required' => 'The :attribute field is required.',
    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ]
    ];
}
