<?php

namespace Database\Seeders;

use App\Models\GymClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GymClassSeeder extends Seeder
{
    public function run()
    {
        $trainers = User::where('role', User::ROLE_TRAINER)->get();
        $classNames = [
            'Yoga Matutino',
            'Crossfit Intenso',
            'Pilates Reformer',
            'Spinning Avanzado',
            'Boxeo Funcional',
            'Zumba Fitness',
            'TRX Training',
            'HIIT Challenge',
            'Body Pump',
            'Karate Dojo'
        ];

        foreach ($trainers as $trainer) {
            for ($i = 0; $i < 3; $i++) { // 3 clases por entrenador
                $start = Carbon::now()->addDays(rand(1, 30))->setHour(rand(8, 20));
                
                GymClass::create([
                    'name' => $classNames[array_rand($classNames)],
                    'description' => 'Clase de alta intensidad para todos los niveles',
                    'trainer_id' => $trainer->id,
                    'start' => $start,
                    'end' => $start->copy()->addHour(),
                    'capacity' => rand(10, 30),
                ]);
            }
        }
    }
}