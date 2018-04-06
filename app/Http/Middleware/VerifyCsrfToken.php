<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */

    
    protected $except = [];

    protected function tokensMatch($request)
	{
    // If request is an ajax request, then check to see if token matches token provider in
    // the header. This way, we can use CSRF protection in ajax requests also.
    $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');

    return $request->session()->token() == $token;
	}

    /*
	public function handle($request, \Closure $next)
    {
        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->shouldPassThrough($request) ||
            $this->tokensMatch($request)
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }

        // Dumps and dies with tokens upon mismatch
        dd(
            $sessionToken = $request->session()->token(),
            $request->input('_token') ?: $request->header('X-CSRF-TOKEN')
        );

        throw new TokenMismatchException;
    }*/
}
