<?php
namespace App\Exceptions;

use Exception;
use App\Enums\ApiHttpStatus;
use App\Jobs\SentryLogJob;
use App\Utils\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array $dontReport
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception Param.
     * @throws Exception Instance of \Exception.
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception))
        {
            if( method_exists( $exception, 'shouldSendToSentry' ) )
            {
                if( $exception->shouldSendToSentry() )
                {
                    dispatch(new SentryLogJob($exception));
                }
            }
            else
            {
                dispatch(new SentryLogJob($exception));
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param mixed     $request   Instance of \Illuminate\Http\Request.
     * @param Exception $exception Instance of \Exception.
     * @return ApiResponse|\Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $response = null;
        $httpCode = ApiHttpStatus::BAD_REQUEST;
        $errorCode = $exception->getCode();

        if (method_exists($exception, 'getExtraParams'))
        {
            $response = $exception->getExtraParams();
        }

        if (method_exists($exception, 'getErrorCode'))
        {
            $errorCode = $exception->getErrorCode();
        }

        if (method_exists($exception, 'getStatusCode'))
        {
            $errorCode = $exception->getStatusCode();
            $httpCode = $exception->getStatusCode();
        }

        $errorMessage = $exception->getMessage();
        if (method_exists($exception, 'getErrorMessage'))
        {
            $errorMessage = $exception->getErrorMessage();
        }

        if (!$errorMessage || empty($errorMessage))
        {
            $errorMessage = trans('messages.fail');
        }

        if (( $request->ajax() || $request->wantsJson() ) && env('APP_DEBUG'))
        {
            $response = ['debug' => ['exception' => get_class($exception)]];

            $trace = null;

            try
            {
                $trace = $exception->getTraceAsString();
            }
            catch (Exception $e)
            {
                $trace = null;
            }

            if ($trace)
            {
                $response['debug']['trace'] = $trace;
            }
        }

        if (Lang::has('messages.common.exceptions.'. get_class($exception)))
        {
            $errorMessage = Lang::get('messages.common.exceptions.'. get_class($exception));
        }

        if (!env('APP_DEBUG', false))
        {
            $errorMessage = trans('messages.fail');
        }

        if( $request->getMethod() == 'OPTIONS' )
        {
            return new ApiResponse(
                [
                    'status' => 'success',
                    'message' => '',
                    'object' => null,
                ],
                204,
                204
            );
        }

        return new ApiResponse(
            [
                'status' => 'fail',
                'message' => $errorMessage,
                'object' => $response,
            ],
            $errorCode,
            $httpCode
        );
    }
}
