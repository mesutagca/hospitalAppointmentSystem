<?php


namespace App\Policies\Traits;

use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use App\Facades\Authenticated;
use Illuminate\Auth\Access\Response;

trait PolicyCommonTrait
{
    private function validateOperationalType(array $allowedOprType): void
    {
        if (!in_array(Authenticated::user()->type, $allowedOprType)) {
            abort(
                prepareCustomResponse("only" .
                    implode(',', $allowedOprType) . "are allowed", 403, ResponseCodes::UNAUTHORIZED)
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

    /**
     * @return bool
     */
    private function isAdmin(): bool
    {
        return Authenticated::user()->type == "admin";
    }
}



