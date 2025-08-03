<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


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

        // Handle all exceptions

        // $exceptions->render(function (Throwable $e, $request) {
        //     try {
        //         $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
        //         $message = $e->getMessage();
        //         $isAdmin = $request->is('admin/*');
        //         $isAuthenticated = Auth::guard('admin')->check();

        //         // Log all errors
        //         Log::error("{$status} Error", [
        //             'status' => $status,
        //             'message' => $message,
        //             'url' => $request->fullUrl(),
        //             'trace' => $e->getTraceAsString(),
        //         ]);

        //         // Redirect to admin login if not authenticated
        //         if ($isAdmin && !$isAuthenticated) {
        //             return redirect()->route('admin.login');
        //         }

        //         // Use a general 400 template for all 4xx errors
        //         $view = $status >= 500
        //             ? 'errors.500'
        //             : 'errors.400';

        //         // Admin-specific views
        //         if ($isAdmin) {
        //             $adminView = str_replace('errors.', 'admin.errors.', $view);
        //             if (view()->exists($adminView)) {
        //                 return response()->view($adminView, compact('message', 'status'), $status);
        //             }
        //         }

        //         return response()->view($view, compact('message', 'status'), $status);
        //     } catch (Throwable $handlerException) {
        //         // Fallback in case even the handler fails
        //         Log::critical('Exception in exception handler: ' . $handlerException->getMessage());

        //         return response()->view('errors.default', [
        //             'message' => $handlerException->getMessage(),
        //             'status' => 500,
        //         ], 500);
        //     }
        // });





        $exceptions->render(function (Throwable $e, $request) {
            try {
                $status = method_exists($e, 'getStatusCode')
                    ? $e->getStatusCode()
                    : ($e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500);

                $message = $e->getMessage() ?: 'An unexpected error occurred.';
                $isAdmin = $request->is('admin/*');

                if ($isAdmin && !Auth::guard('admin')->check()) {
                    return redirect()->route('admin.login');
                }

                // Map status code ranges to template types
                $templateGroup = match (true) {
                    $status >= 500 => '500',
                    in_array($status, [400, 401, 403, 404, 405]) => '400',
                    default => 'fallback',
                };

                // Try to load a more specific error view first (e.g., 404, 405), fall back to group view
                $specificView = $isAdmin ? "admin.errors.{$status}" : "errors.{$status}";
                $groupView = $isAdmin ? "admin.errors.{$templateGroup}" : "errors.{$templateGroup}";

                $viewToUse = view()->exists($specificView) ? $specificView : (view()->exists($groupView) ? $groupView : ($isAdmin ? 'errors.admin.fallback' : 'errors.fallback'));

                // Log only 500-level and fallback errors
                if ($status >= 500 || $templateGroup === 'fallback') {
                    Log::error("[$status] Error: {$message}", [
                        'url' => $request->fullUrl(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }

                return response()->view($viewToUse, [
                    'status' => $status,
                    'message' => $message,
                ], $status);
            } catch (Throwable $handlerError) {
                //dd('Error in exception handler: ' . $handlerError->getMessage());
                Log::critical('Exception inside error handler: ' . $handlerError->getMessage());

                if ($request->is('admin/*')) {
                    if (Auth::guard('admin')->check()) {
                        return response()->view('admin.errors.fallback', [
                            'status' => 500,
                            'message' => 'Something went wrong while processing your request.',
                        ], 500);
                    }
                    return redirect()->route('admin.login');
                }
                return response()->view('errors.fallback', [
                    'status' => 500,
                    'message' => 'Something went wrong while processing your request.',
                ], 500);
            }
        });
    })->create();
