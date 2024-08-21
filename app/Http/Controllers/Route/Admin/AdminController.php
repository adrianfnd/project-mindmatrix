<?php

namespace App\Http\Controllers\Route\Admin;

use App\Models\User;
use App\Models\Biodata;
use App\Models\TestDescription;
use App\Models\LogTestUser;
use App\Models\Universitas;
use App\Models\JurusanUniversitas;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Component\Login\LoginController as C_login;
class AdminController extends C_login
{
    public function dashboard()
    {
        $totalUsers = DB::table('users')->count();

        $activeTests = DB::table('test_descriptions')->count();

        $totalUniversities = DB::table('universitas')->count();

        $totalMajors = DB::table('jurusan_universitas')->count();

        $userRegistrations = DB::table('users')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $registrationLabels = $userRegistrations->pluck('date')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('M d');
        });
        
        $registrationValues = $userRegistrations->pluck('count');

        $totalUsers = DB::table('users')->count();

        $totalUniversities = DB::table('universitas')->count();

        $comparisonLabels = ['Users', 'Universities'];
        $comparisonValues = [$totalUsers, $totalUniversities];

        $visitData = [
            'labels' => $registrationLabels,
            'values' => $registrationValues,
        ];

        $userTypeData = [
            'labels' => $comparisonLabels,
            'values' => $comparisonValues,
        ];

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'activeTests',
            'totalUniversities',
            'totalMajors',
            'registrationLabels',
            'registrationValues',
            'visitData',
            'userTypeData'
        ));
    }


    public function admin_logout(){
        $status = $this->logout();
        if($status == false){
            return back();
        }
        return redirect()->route('login.page');
    }
}
