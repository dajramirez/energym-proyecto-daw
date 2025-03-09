<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass;
use Illuminate\Support\Facades\Auth;


class TrainerController extends Controller
{
    public function trainerDashboard() {
        
        $classes = GymClass::where('trainer_id', Auth::id())
            ->withCount('members')
            ->orderBy('start')
            ->get();

        return view('trainer.dashboard', compact('classes'));
    }

    public function createClass() {
        return view('trainer.classes.create');
    }

    public function storeClass(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'capacity' => 'required|integer|min:1',
        ]);

        GymClass::create([
            ...$validated,
            'trainer_id' => Auth::id()
        ]);

        return redirect()->route('trainer.dashboard')->with('success', 'Clase creada con éxito.');
    }

    public function editClass(GymClass $class) {
        
        if($class->trainer_id !== Auth::id()) {
            abort(403, 'Unauthorized', $headers);
        }

        return view('trainer.classes.edit', compact('class'));
    }

    public function updateClass(Request $request, GymClass $class) {

        if($class->trainer_id !== Auth::id()){
            abort(403, 'Unauthorized', $headers);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'capacity' => 'required|integer|min:1',
        ]);

        $class->update($validated);
        return redirect()->route('trainer.dashboard')->with('success', 'Clase actualizada');
    }

    public function destroyClass(GymClass $class){

        if($class->trainer_id !== Auth::id()){
            abort(403, 'Unauthorized', $headers);
        }

        $class->delete();
        return redirect()->route('trainer.dashboard')->with('success', 'Clase eliminada');
    }
}
