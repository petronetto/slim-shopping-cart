<?php

namespace Cart\Validation\Forms;

use Cart\Validation\Contracts\ValidatiorFormInterface;
use Respect\Validation\Validator as v;

class OrderForm implements ValidatiorFormInterface
{
    public static function rules(): array
    {
        return [
            'email'    => v::email(),
            'name'     => v::alpha(' '),
            'address1' => v::alnum(' -'),
            'address2' => v::optional(v::alnum(' -')),
            'city'     => v::alnum(' '),
            'zip'      => v::alnum(' '),
        ];
    }
}
