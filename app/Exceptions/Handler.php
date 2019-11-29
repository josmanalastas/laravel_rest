<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {MethodNotAllowedHttpException
            $status = $exception->status;
            $message = collect($exception->errors())
                ->map(function ($item, $key) {
                    return [$key => $item[0]];
                })
                ->mapWithKeys(function ($item) {
                    return $item;
                })
                ->join(", ");
            return response()->json(
                [
                    'status' => $status,
                    'error' => (isset($message) ? $message : $exception->getMessage())
                ],
                $status
            );
        } else {
            return parent::render($request, $exception);
        }

    }
}
