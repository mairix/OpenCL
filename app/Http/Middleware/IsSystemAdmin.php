<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use App\Models\User;

class IsSystemAdmin
{
    public function handle($request, Closure $next)
    {
		if ( Auth::check() )
		{
			$User = User::find( Auth::user()->id );
			return ( $User->group == 'administrator' ) ? $next( $request ) : back();
		} else {
			return back();
		}
    }
}