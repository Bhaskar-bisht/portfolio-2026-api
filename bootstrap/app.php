<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Custom CORS middleware dono web aur API ke liye
        $middleware->web(prepend: [
            \App\Http\Middleware\Cors::class,
        ]);

        $middleware->api(prepend: [
            \App\Http\Middleware\Cors::class,
        ]);

        // Disable CSRF for API routes
        $middleware->validateCsrfTokens(except: [
            'api/*',
            'sanctum/csrf-cookie',
            'profile',
            'login',
            'logout'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
