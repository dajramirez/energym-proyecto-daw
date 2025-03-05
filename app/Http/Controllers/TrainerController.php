<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GymClass;
use Illuminate\Support\Facades\Auth;


class TrainerController extends Controller
{
    public function index() {
        
        $classes = GymClass::where('trainer_id', Auth::id())
            ->withCount('members')
            ->orderBy('start')
            ->get();

        return view('dashboard.trainer', compact('classes'));
    }

    public function create() {
        return view('trainer.classes.create');
    }

    public function store(Request $request) {

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

        return redirect()->route('trainer.classes')->with('success', 'Clase creada con éxito.');
    }

    public function edit(GymClass $class) {
        
        if($class->trainer_id !== Auth::id()) {
            abort(403, 'Unauthorized', $headers);
        }

        return view('trainer.classes.edit', compact('class'));
    }

    public function update(GymClass $class) {

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
        return view('trainer.classes')->with('success', 'Clase actualizada');
    }

    public function destroy(GymClass $class){

        if($class->trainer_id !== Auth::id()){
            abort(403, 'Unauthorized', $headers);
        }

        $class->delete();
        return view('trainer.classes')->with('success', 'Clase cancelada');
    }
}
