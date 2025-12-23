<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\UpdateUserActiveAt;
use App\Http\Middleware\MarkNotificationAsRead;
use App\Http\Middleware\CheckApiToken;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\SetAppLocale;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web([
            UpdateUserActiveAt::class,
            MarkNotificationAsRead::class,
            SetAppLocale::class,

        ]);
        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
            'permission' => CheckPermission::class
        ]);
        $middleware->api([
            // CheckApiToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // $exceptions->reportable(function (QueryException $e) {
        //     if ($e->getCode() == 23000) {
        //         $message = 'هذا الحقل موجود بالفعل';
        //     } else {
        //         $message = $e->getMessage();
        //     }
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->withErrors([
        //             'message' => $message,

        //         ])
        //         ->with('info', $message);

        // });
        //with Log:: facad
        $exceptions->reportable(function (QueryException $e) {
            if($e->getCode()== 23000){
                Log::channel('sql')->warning($e->getMessage());
            }
            // Log::error($e->getMessage());
            // Log::info($e->getMessage());
            // Log::warning($e->getMessage());
            // Log::debug($e->getMessage());
            // Log::channel('database')->error($e->getMessage());

        });



        $exceptions->renderable(function (QueryException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'code' => $e->getMessage(),
                ], 500);
            }
        });
    })->create();
