<?php

namespace App\Services\ValidationService;

use Psr\Http\Message\ServerRequestInterface;

class ValidationService
{
    public function validate(ServerRequestInterface $request, array $params)
    {
        $errors = [];
        foreach($params as $param) {
            $requestParam = $request->getParsedBody()[$param->object];
            if (strlen($requestParam) > $param->maxLength) {
                $errors[] = "$param->object can't be longer than $param->maxLength";
            }
            if (strlen($requestParam) < $param->minLength) {
                $errors[] = "$param->object can't be shorter than $param->minLength";
            }
        }

        return $errors;
    }
}