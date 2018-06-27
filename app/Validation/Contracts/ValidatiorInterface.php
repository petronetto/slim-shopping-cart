<?php

namespace Cart\Validation\Contracts;

use Psr\Http\Message\ServerRequestInterface as Request;

interface ValidatiorInterface
{
    public function validate(Request $request, array $rules);

    public function fails(): bool;
}
