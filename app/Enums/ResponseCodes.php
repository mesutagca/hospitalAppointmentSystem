<?php


namespace App\Enums;


class ResponseCodes
{
    const ENTITY_NOT_FOUND = 404;

    const ROUTE_NOT_FOUND = 404;

    const UNAUTHORIZED = 403;

    const BLOCKED_BY_POLICY = 403;

    const METHOD_NOT_FOUND = 405;

    const BRANCH_ALREADY_EXISTS = 409;

    const DIAGNOSE_ALREADY_EXISTS =409 ;

    const MEDICINE_COMPANY_ALREADY_EXISTS = 409;

    const MEDICINE_ALREADY_EXISTS = 409;
    const APPOINTMENT_ALREADY_EXISTS = 409;

    const DOCTOR_DOESNT_EXISTS =405 ;

}
