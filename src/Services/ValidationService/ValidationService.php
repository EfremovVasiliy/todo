<?php

namespace App\Services\ValidationService;

use Psr\Http\Message\ServerRequestInterface;

class ValidationService
{
    public function validate(ServerRequestInterface $request, array $params): array
    {
        $errors = [];
        foreach($params as $param) {
            $requestParam = $request->getParsedBody()[$param->object];
            if (strlen($requestParam) >= $param->maxLength && $param->maxLength) {
                $errors[] = "$param->object can't be longer than $param->maxLength";
            }
            if (strlen($requestParam) <= $param->minLength && $param->minLength) {
                $errors[] = "$param->object can't be shorter than $param->minLength";
            }
            if (!filter_var($requestParam, $param->type)) {
                $errors[] = ucfirst($param->object).' has incorrect type';
            }
        }

        return $errors;
    }
}