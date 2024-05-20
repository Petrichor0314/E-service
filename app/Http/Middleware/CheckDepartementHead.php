<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\DepartementModel;


class CheckDepartementHead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($this->isDepartementHead($user->id)) {
            return $next($request);
        }
        else {
            Auth::logout();

            return redirect(url(''))->with('error', 'Access denied. You are not a departement head.');
        }

    }

    protected function isDepartementHead($userId)
    {
        return DepartementModel::where('head', $userId)->exists();
    }
}
