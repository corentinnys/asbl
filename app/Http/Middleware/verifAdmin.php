<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UsersController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class verifAdmin
{
    private $_userController;
    public  function __construct(UsersController $usersController)
    {
        $this->_userController = $usersController;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && $this->_userController->getByMailAndRole(auth()->user()->email))
        {
            return $next($request);
        }
        else{
            abort(403);
        }
    }
}
