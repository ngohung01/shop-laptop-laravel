<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
	public function handle(Request $request, Closure $next)
	{
		if(Auth::check())
		{
			if(auth()->user()->role != 'user'){
				return redirect('/admin');
			}
			return $next($request);
		}
		return redirect()->route('user.dangnhap');
	}
}