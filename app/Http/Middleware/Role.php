<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$give_permission): Response
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
        $user_roles = Auth::user()->getRoleNames();
        foreach($user_roles as $role){
            $role = strtolower($role);
            $give_permission = strtolower($give_permission);
            if($role == $give_permission){
                return $next($request);
            }
        }
        return abort(403,"gak boleh ke sini ya ? putar balik sana");
    }
}
