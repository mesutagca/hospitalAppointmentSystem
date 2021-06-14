<?php

use App\Facades\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if (!function_exists('convert_obj_from_props')) {
    /**
     * özellikleri verilmiş objeden istenen objeyi üreyir
     *
     * @param string $className
     * @param array|object $items
     * @return array|\App\Models\Entities\Base
     */
    function convert_obj_from_props(string $className, $items)
    {
        if (is_object($items)) {
            return new $className($items);
        }

        $objectsContainer = [];

        foreach ($items as $item) {
            $objectsContainer[] = new $className($item);
        }

        return $objectsContainer;
    }
}

if (!function_exists('is_json')) {

    function is_json($string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
if (!function_exists('getRequestDetail')) {

    function getRequestDetail($request): array
    {
        [$class, $method] = explode('@', Arr::last(explode('\\', $request->route()->getActionName())));
        $class = substr($class, 0, mb_strpos($class, 'Controller'));
        $operation = Str::lower("{$class}_{$method}");
        return [$class, $method, $operation];
    }
}

if (!function_exists('responseToObject')) {

    function responseToObject($response)
    {
        if (isset($response->data)) {
            return json_decode($response->data);
        }
        return json_decode($response);
    }
}

if (!function_exists('getModelChanges')) {

    function getModelChanges($item, string $prefix = ""): array
    {
        $changes = array();
        foreach ($item->getDirty() as $key => $value) {
            $original = $item->getOriginal($key);
            $changes[$prefix . $key] = [
                'old' => $original,
                'new' => $value,
            ];
        }
        return $changes;
    }
}

if (!function_exists('getLoginUserCacheKey')) {
    function getLoginUserCacheKey(): string
    {
        if (Profile::check()) {
            return Profile::getUser()->id . '-' . Profile::getOrganizationType();
        }
        return "notLogin";
    }
}

if (!function_exists('setHeader')) {

    function setHeader(array $header): array
    {
        $headers = request()->headers->all();
        $headers = Arr::only($headers, [
            "x-scheme",
            "x-forwarded-port",
            "x-forwarded-host",
            "x-forwarded-proto",
            "x-forwarded-for",
            "x-real-ip",
            "x-request-id",
            "host"
        ]);
        return array_merge($headers, $header);
    }
}

if (!function_exists('convertToBoolean')) {

    function convertToBoolean($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}

if (!function_exists('randomValue')) {

    function randomValue(array $array)
    {
        $key = array_rand($array);
        return $array[$key];
    }
}

if (!function_exists('randomKey')) {

    function randomKey(array $array)
    {
        return array_rand($array) + 1;
    }
}

if (!function_exists('randomIndex')) {

    function randomIndex(array $array)
    {
        return array_rand($array);
    }
}

if (!function_exists('searchKey')) {

    function searchKey($needle, array $array)
    {
        return array_search($needle, $array) + 1;
    }
}

if (!function_exists('searchIndex')) {

    function searchIndex($needle, array $array)
    {
        return array_search($needle, $array);
    }
}

if (!function_exists('arrayToList')) {

    function arrayToList(array $array): string
    {
        return implode(',', $array);
    }
}

if (!function_exists('keyValueToArray')) {

    function keyValueToArray(string $key, $value): array
    {
        return [
            "key" => $key,
            "value" => $value
        ];
    }
}

if (!function_exists('associativeToKeyValueArray')) {

    function associativeToKeyValueArray(array $array): array
    {
        $returnArray = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }

            $returnArray[] = [
                "key" => $key,
                "value" => $value
            ];
        }

        return $returnArray;
    }
}

if (!function_exists('prepareCustomResponse')) {

    function prepareCustomResponse($message, int $statusCode, $code)
    {
        return response(["message" => $message, "code" => $code], $statusCode);
    }
}




