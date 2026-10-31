<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->validateCsrfTokens(except: ['buat-laporan', 'admin/login', 'admin/laporan/*', 'admin/logout', 'login', 'register', 'login/google', 'api/chatbot']);
        $middleware->encryptCookies(except: ['admin_token']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
