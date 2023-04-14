<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProviderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authToken = getenv('AUTH_TOKEN');
         if (!$request->hasHeader('X-REQUEST-SIGN'))
         {
             return response(['error'=>'Bad Request'],400);
         }

         $requestSignature = $request->header('X-REQUEST-SIGN');

         $requestContent = $request->getContent();

         $calculatedSignature = hash_hmac('sha256',$requestContent,$authToken);

         if ($calculatedSignature !== $requestSignature)
         {
             return response(['error'=>'Unauthorized'],401);
         }


         return $next($request);
    }
}
