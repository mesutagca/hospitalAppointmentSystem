<?php


namespace App\Policies\Traits;

use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use Illuminate\Auth\Access\Response;

trait PolicyCommonTrait
{
    private function validateOperationalType(string $type, array $allowedOprType): void
    {
        if (!in_array($type, $allowedOprType)) {
            abort(
                prepareCustomResponse("only" .
                    implode(',', $allowedOprType) . "is allowed", 403, ResponseCodes::UNAUTHORIZED)
            );
        }
    }

    private function customDeny($message, $code): Response
    {
        abort(
            prepareCustomResponse($message, 403, $code)
        );

        return Response::deny($message);
    }
}



