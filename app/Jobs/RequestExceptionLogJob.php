<?php


namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RequestExceptionLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Exception $exception;
    private Request $request;
    private object $profile;

    /**
     * Create a new job instance.
     *
     * @param Exception $exception
     * @param Request $request
     * @param object $profile
     */
    public function __construct(Exception $exception, Request $request, object $profile)
    {
        $this->exception = $exception;
        $this->request = $request;
        $this->profile = $profile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reqDetail = getRequestDetail($this->request);
        Log::error("Request exception log", array_merge([
            'url' => $this->request->url(),
            'action_name' => $this->request->route()->getActionName(),
            'action_class' => $reqDetail[0],
            'action_function' => $reqDetail[1],
            'operation' => $reqDetail[2],
            'method' => $this->request->getMethod(),
            'user' => $this->profile->user->id,
           // 'organization' => $this->profile->organization_id,
           // 'organization_type' => $this->profile->organization_type,
           // 'status_code' => $this->exception->getCode(),
            'error' => $this->exception->getMessage(),
            'exec_time' => microtime(true) - LARAVEL_START,
            'type' => 'request_exception'
        ], $this->request->all()));
    }


}
