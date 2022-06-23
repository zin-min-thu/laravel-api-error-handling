<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use ParseError;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        // eg. Model not nound exception
        $this->renderable(function (NotFoundHttpException $e, $request) {
            // if ($request->wantsJson()) { // first way
            //     return response()->json(['message' => 'Object not found'], 404);
            // }
            if ($request->is('api/*')) { // Second way
                // return response()->json(['message' => 'Object not found'], 404);
            }
        });

        // eg. Wrong santax error, spelling error
        $this->renderable(function (ParseError $e, $request) {
            // if ($request->wantsJson()) { // first way
            //     return response()->json(['message' => 'Internal server error'], 500);
            // }
            if ($request->is('api/*')) { // Second way
                // return response()->json(['message' => $e->getMessage() . ' Line:' . $e->getLine()], 500);
            }
        });

        // eg. Store update query exception
        $this->renderable(function (QueryException $e, $request) {
            // if ($request->wantsJson()) { // first way
            //     return response()->json(['message' => 'Not update in system'], 500);
            // }
            if ($request->is('api/*')) { // Second way
                return response()->json(['message' => 'Server error, not update in system'], 500);
                // return response()->json(['message' => $e->getMessage() . ' Line:' . $e->getLine()], 404);
                // return response()->json(['message' => $e], 404);
            }
        });

        // eg. api http request if not function exist
        $this->renderable(function (BadMethodCallException $e, $request) {
            // if ($request->wantsJson()) { // first way
            //     return response()->json(['message' => 'Bad method call exception'], 500);
            // }
            if ($request->is('api/*')) { // Second way
                return response()->json(['message' => 'Bad method call exception'], 500);
                // return response()->json(['message' => $e->getMessage() . ' Line:' . $e->getLine()], 404);
                // return response()->json(['message' => $e], 404);
            }
        });
    }
}
