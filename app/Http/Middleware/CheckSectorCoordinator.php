<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\FiliereModel;
use Illuminate\Support\Facades\Auth;


class CheckSectorCoordinator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $user = Auth::user();

    if ($this->isSectorCoordinator($user->id)) {
        return $next($request);
    } else {
        Auth::logout();
        
        return redirect(url(''))->with('error', 'Access denied. You are not a sector coordinator.');
    }
}

    protected function isSectorCoordinator($userId)
    {
        return FiliereModel::where('coord', $userId)->exists();
    }
}
