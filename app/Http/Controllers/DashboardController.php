<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GymClass;


class DashboardController extends Controller
{
    public function userDashboard() {
        
        $user = Auth::user();

        $classes = GymClass::withCount('members')
            ->where('start', '>', now())
            ->with(['trainer', 'members'])
            ->get()
            ->map(function ($class) use ($user){
                $class->is_enrolled = $class->members->contains($user);
                return $class;
            });
        
        return match ($user->role) {
            'admin' => view('dashboard.admin'),
            'clerk' => view('dashboard.clerk'),
            'trainer' => view('dashboard.trainer'),
            'user' => view('dashboard.user', compact($class)),
        };
    }
}
