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
            'company'=> 'exists:companies,id',
            'cupom'=> 'nullable|exists:cupoms,code,used,0',
            'items'=> 'required'
        ]
    ];
}
