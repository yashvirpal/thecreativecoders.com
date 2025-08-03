<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend(\Illuminate\Session\Middleware\StartSession::class);

        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'admin.permission' => \App\Http\Middleware\CheckAdminPermission::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // $exceptions->render(function (NotFoundHttpException $e, $request) {
        //     if ($request->is('admin/*')) {

        //         if (Auth::guard('admin')->check()) {
        //             return response()->view('errors.admin.404', [], 404);
        //         }
        //         return redirect()->route('admin.login');
        //     }
        //     // Other 404 pages for regular users
        //     return response()->view('errors.404', [], 404);
        // });
        // $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
        //     if ($request->is('admin/*')) {

        //         if (Auth::guard('admin')->check()) {
        //             return response()->view('errors.admin.405', [], 405);
        //         }
        //         return redirect()->route('admin.login');
        //     }
        //     // Other 404 pages for regular users
        //     return response()->view('errors.405', [], 405);
        // });
        // $exceptions->render(function (ModelNotFoundException $e, $request) {
        //     // Treat model not found as 404
        //     if ($request->is('admin/*')) {
        //         if (Auth::guard('admin')->check()) {
        //             return response()->view('errors.admin.404', [], 404);
        //         }
        //         return redirect()->route('admin.login');
        //     }
        //     return response()->view('errors.404', [], 404);
        // });



        // $exceptions->render(function (NotFoundHttpException $e, $request) {
        //     try {
        //         $message = $e->getMessage();
        //         if ($request->is('admin/*')) {
        //             if (Auth::guard('admin')->check()) {
        //                 return response()->view('admin.errors.404', ['message' => $message], 404);
        //             }
        //             return redirect()->route('admin.login');
        //         }
        //         return response()->view('errors.404', ['message' => $message], 404);
        //     } catch (Throwable $handlerException) {
        //         Log::error('Exception in 404 handler: ' . $handlerException->getMessage());
        //         return response()->view('errors.404', [
        //             'message' => $handlerException->getMessage(),
        //         ], 404);
        //     }
        // });

        // $exceptions->render(function (Throwable $e, $request) {

        //     try {
        //         $message = $e->getMessage();

        //         if ($request->is('admin/*')) {
        //             if (Auth::guard('admin')->check()) {
        //                 Log::error('Admin 500 Error', [
        //                     'message' => $message,
        //                     'url' => $request->fullUrl(),
        //                     'trace' => $e->getTraceAsString(),
        //                 ]);

        //                 return response()->view('errors.admin.500', ['message' => $message], 500);
        //             }
        //             return redirect()->route('admin.login');
        //         }

        //         Log::error('500 Error', [
        //             'message' => $message,
        //             'url' => $request->fullUrl(),
        //             'trace' => $e->getTraceAsString(),
        //         ]);

        //         return response()->view('errors.500', ['message' => $message], 500);
        //     } catch (Throwable $handlerException) {
        //         dd($handlerException);
        //         Log::error('Exception in 500 handler: ' . $handlerException->getMessage());
        //         return response()->view('errors.fallback', [
        //             'message' => $handlerException->getMessage(),
        //         ], 500);
        //     }
        // });



        $exceptions->render(function (Throwable $e, $request) {
            try {
                $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
                $message = $e->getMessage();
                $isAdmin = $request->is('admin/*');
                $isAuthenticated = Auth::guard('admin')->check();

                // Log all errors
                Log::error("{$status} Error", [
                    'status' => $status,
                    'message' => $message,
                    'url' => $request->fullUrl(),
                    'trace' => $e->getTraceAsString(),
                ]);

                // Redirect to admin login if not authenticated
                if ($isAdmin && !$isAuthenticated) {
                    return redirect()->route('admin.login');
                }

                // Use a general 400 template for all 4xx errors
                $view = $status >= 500
                    ? 'errors.500'
                    : 'errors.400';

                // Admin-specific views
                if ($isAdmin) {
                    $adminView = str_replace('errors.', 'admin.errors.', $view);
                    if (view()->exists($adminView)) {
                        return response()->view($adminView, compact('message', 'status'), $status);
                    }
                }

                return response()->view($view, compact('message', 'status'), $status);
            } catch (Throwable $handlerException) {
                // Fallback in case even the handler fails
                Log::critical('Exception in exception handler: ' . $handlerException->getMessage());

                return response()->view('errors.fallback', [
                    'message' => $handlerException->getMessage(),
                    'status' => 500,
                ], 500);
            }
        });
    })->create();
