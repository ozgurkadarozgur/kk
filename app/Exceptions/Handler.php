<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        $host = explode('.', $request->getHost())[0];

        switch ($host) {
            case 'api' : {
                if ($exception instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 'url_not_found',
                    ]);
                }

                 if ($exception instanceof AuthenticationException) {
                    return response()->json([
                        'status' => 'unauthenticated',
                    ]);
                }

                if ($exception instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'status' => 'method_not_allowed',
                        'message' => $exception->getMessage(),
                    ]);
                }

            }
        }
        return parent::render($request, $exception);
    }
}
