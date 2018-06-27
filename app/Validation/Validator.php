<?php

namespace Cart\Validation;

use Cart\Validation\Contracts\ValidatiorInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;

class Validatior implements ValidatiorInterface
{
    protected $errors = [];

    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }
}
