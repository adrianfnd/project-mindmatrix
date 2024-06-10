<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Auth
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,$role_permission): Response
    {
        $acceptHader = $request->header('Accept');
        $header_akses = strpos($acceptHader,'application/json');
        if(!Auth::check()){
            if($header_akses == true){
                return response()->json([
                    'pesan' => "Silahakn lakukan login terlebih dahulu",
                ],403);
            }
            return redirect()->route('login.page');
        }
        $user_role = Auth::user()->getRoleNames();
        dd($user_role);

    }
}
