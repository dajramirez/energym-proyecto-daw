<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GymClass;


class ClassController extends Controller
{
    public function enroll(GymClass $class) {
        if($class->members_count >= $class->capacity) {
            return back()->with('error', 'No hay plazas disponibles');
        }

        Auth::user()->classes()->attach($class);
        return back()->with('success', 'Inscripción realizada correctamente');
    }

    public function unenroll(GymClass $class) {
        Auth::user()->classes()->detach($class);
        return back()->with('success', 'Inscripción cancelada');
    }
}
