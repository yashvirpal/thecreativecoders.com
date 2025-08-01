<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */public function __construct(Container $container)
{
    parent::__construct($container);
    dd('Handler constructor called'); // this WILL now fire
}

    public function registerr()
    {
        $this->reportable(function (Throwable $e) {
            //
        });



        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Resource not found.'], 404);
            }
            return redirect()->route('admin.error.404');
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Invalid request method for this action.'], 405);
            }
            dd("aaaaaa  " . $e->getMessage());
            Log::error('MethodNotAllowedHttpException: ' . $e->getMessage());
            return redirect()->route('admin.error.405');

            // return response()->view('errors.405', [], 405);
            // return redirect()->back()->withErrors(['error' => 'Invalid request method for this action.']);
        });
    }

    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            if (Str::startsWith($request->path(), 'admin')) {
                return response()->view('admin.errors.404', [], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Method Not Allowed'], 405);
            }

            if (Str::startsWith($request->path(), 'admin')) {
                return response()->view('admin.errors.405', [], 405);
            }

            return response()->view('errors.405', [], 405);
        });
    }

    /**
     * Override default unauthenticated handler to support custom guards like 'admin'
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        $guard = $exception->guards()[0] ?? null;

        switch ($guard) {
            case 'admin':
                $login = route('admin.login');
                break;
            default:
                $login = route('login'); // fallback for default users
                break;
        }

        return redirect()->guest($login);
    }
}
