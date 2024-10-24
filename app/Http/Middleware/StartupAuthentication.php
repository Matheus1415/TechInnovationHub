<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StartupAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if ($user->typeUser != 3 || $user->typeUser != 4) {
            return response()->json([
                'message' => 'Você não tem permissão para criar uma startup.'
            ], 403); 
        }

        return $next($request);
    }
}
