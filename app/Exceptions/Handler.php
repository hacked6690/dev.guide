<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        /* When we've got non-matched route resulting in "404 Not Found" response. */
        // if ($exception instanceof NotFoundHttpException)
        // {
        //     $config = app('config');
        //     $fallback_locale = $config['app.fallback_locale'];
        //     $locale = $request->segment(1);

        //     /* See if locale in url is absent or isn't among known languages. */
        //     if (!\in_array($locale, $config['app.locale']))
        //     {
        //         /* Redirect to same url with default locale prepended. */
        //         $uri = $request->getUriForPath('/' . $fallback_locale . $request->getPathInfo());

        //         return redirect($uri, 301);
        //     }
        // }
        if($this->isHttpException($exception))
        {
            switch($exception->getStatusCode()){
                 case 401:
                    return redirect()->route('notfound');
                    break;
                case 404:
                    return redirect()->route('notfound');
                    break;
                case 500:
                    return redirect()->route('notfound');
                    break;
                default:
                    return $this->renderHttpException($exception);
                    break;

            }
        }else{
            return parent::render($request, $exception);
        }

        
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
