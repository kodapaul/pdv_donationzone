<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use PDOException;
use ErrorException;
use BadMethodCallException;;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->renderable(function (PDOException $e, $request) {
            abort(500);
        });

        $this->renderable(function (
            QueryException $e,
            $request
        ) {
            abort(500);
        });

        $this->renderable(function (
            ErrorException $e,
            $request
        ) {
            abort(500);
        });

        $this->renderable(function (
            BadMethodCallException $e,
            $request
        ) {
            abort(500);
        });
    }
}
