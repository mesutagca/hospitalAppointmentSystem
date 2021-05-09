<?php

namespace App\Services\Traits;

use App\Enums\ResponseCodes;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait HttpClientTrait
{
    private string $apiBaseUrl;
    private int $requestTimeout = 8;
    private array $headers;
    private string $token;

    /**
     * @param $service
     * @param $version
     * @param $url
     * @return $this
     */
    private function setBaseUrlWithService($service, $version, $url): self
    {
        $this->apiBaseUrl = $url . '/' . $service . '/' . $version . '/';
        return $this;
    }

    /**
     * @param string $url
     * @param array $params
     * @return object
     * @throws AuthorizationException
     */
    private function httpGet(string $url, array $params = []): object
    {
        $url = $this->getUrl($url);
        $client = $this->createClient();
        $res = $client->get($url, $params);
        $this->requestExceptionHandler($res, $url);

        return $res->object();
    }

    /**
     * @param string $url
     * @return string
     */
    private function getUrl(string $url): string
    {
        return $this->apiBaseUrl . $url;
    }

    /**
     * @return PendingRequest
     */
    private function createClient(): PendingRequest
    {
        $client = Http::timeout($this->requestTimeout)
            ->withOptions(['verify' => false]);

        if (!isset($this->headers)) {
            $this->setDefaultHeaders();
        }

        if (!isset($this->token)) {
            //set default token if necessary
            $this->setDefaultToken();
        }

        if (isset($this->token)) {
            $this->headers["Authorization"] = $this->token;
        }

        if (isset($this->headers)) {
            $client->withHeaders($this->headers);
        }

        return $client;
    }

    /**
     * @param Response $response
     * @param string $url
     * @throws AuthorizationException|NotFoundHttpException|HttpException
     */
    private function requestExceptionHandler(Response $response, string $url): void
    {
        if ($response->object() === null) {
            abort(prepareCustomResponse("Entity not found", 404, ResponseCodes::ENTITY_NOT_FOUND));
        }
        if ($response->clientError()) {
            if ($response->status() == 401 || $response->status() == 403 || $response->status() == 422) {
                throw new AuthorizationException();
            }
            throw new NotFoundHttpException($response->body(), null, 404);
        }

        if ($response->serverError()) {
            $message = "Request Exception: " . $response->body() . "(" . $url . ")";
            throw new HttpException(500, 'API Request Exception : ' . $message);
        }
    }

    /**
     * @param array $headers
     */
    private function setHeaders(array $headers)
    {
        $headers = array_merge(['accept' => 'application/json'], $headers);
        $this->headers = setHeader($headers);
    }

    private function setDefaultHeaders()
    {
        $this->setHeaders([]);
    }

    /**
     * @param string $token
     * @return $this
     */
    private function setToken(string $token): self
    {
        $this->token = $token;
        if (!str_starts_with($token, 'Bearer')) {
            $this->token = "Bearer " . $token;
        }

        return $this;
    }

    private function setDefaultToken(): void
    {
        if (request()->headers->has("Authorization")) {
            $this->setToken(request()->header('Authorization'));
        }
    }

    /**
     * @param string $returnType
     * @param $data
     * @param $model
     * @return array|array[]|Collection
     */
    private function transform(string $returnType, $data, $model)
    {
        if ($returnType === "model") {
            return convert_obj_from_props($model, $data);
        }
        if ($returnType === "array") {
            if (is_array($data)) {
                return array_map(function ($item) {
                    return (array)$item;
                }, $data);
            }
            return Arr::wrap((array)$data);
        }
        if ($returnType === "collection") {
            if (is_array($data)) {
                $data = array_map(function ($item) {
                    return (array)$item;
                }, $data);
            }
            return collect($data);
        }
        return $data;
    }
}

