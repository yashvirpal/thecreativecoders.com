<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.permission' => \App\Http\Middleware\CheckAdminPermission::class,
            'auth' => \App\Http\Middleware\Authenticate::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Resource not found.'], 404);
            }

            Log::error('404 Not Found: ' . $e->getMessage());
            return response()->view('errors.404', [], 404);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Invalid request method.'], 405);
            }

            Log::error('405 Method Not Allowed: ' . $e->getMessage());
            return response()->view('errors.405', [], 405);
        });
    })->create();
