<?php

namespace App\Exceptions;

use App\Http\Responses\ExpectionFailedResponse;
use App\Http\Responses\PreConditionFailedResponse;
use App\Http\Responses\ServerErrorResponse;
use App\Http\Responses\UrlNotFoundResponse;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $e
     * @return ExpectionFailedResponse|PreConditionFailedResponse|ServerErrorResponse|UrlNotFoundResponse|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if( $request->wantsJson() )
        {
            if ($e instanceof NotFoundHttpException || $e instanceof MethodNotAllowedHttpException  )
                return new UrlNotFoundResponse( $e );

            if ($e instanceof ValidationException)
                return new PreConditionFailedResponse( $e->errors() );

            if ($e instanceof QueryException)
            {
                try {

                    DuplicationDBRecordException::detectAndThrow($e);
                    DeleteDBRecordException::detectAndThrow($e);

                    return new ServerErrorResponse( $e );
                }catch ( \Exception $ex ){
                    return new ExpectionFailedResponse( errorKeyMessage( $ex->getMessage()  )  );
                }
            }

            return new ExpectionFailedResponse( errorKeyMessage( $e->getMessage()  )  );
        }else
        {
            return parent::render($request, $e);
        }
    }
}
