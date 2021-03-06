<?php

namespace App\Exceptions;

use App\Exceptions\Catchers\AuthenticationCatcher;
use App\Exceptions\Catchers\Database\NotFoundCatcher;
use App\Exceptions\Catchers\ValidationCatcher;
use App\Exceptions\Entities\Cars\CarNotFoundException;
use Exception;
use Experus\Exceptions\Dispatcher as DispatchesExceptions;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    use DispatchesExceptions;

    private $catchers = [
        NotFoundCatcher::class => [
            CarNotFoundException::class,
        ],
        ValidationCatcher::class => [
            ValidationException::class,
        ],
        AuthenticationCatcher::class => [
            AuthenticationCatcher::class,
        ]
    ];

    protected $blacklist = [
    ];

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
    ];

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
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
