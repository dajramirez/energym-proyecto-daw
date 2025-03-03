<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    protected $fillable = [
        'name',
        'description',
        'trainer_id',
        'start',
        'end',
        'capacity',
    ];

    protected $casts = [
        'start' => 'datetime:d/m/Y H:i',
        'end' => 'datetime:d/m/Y H:i',
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'class_members')
            ->withTimestamps();
    }
}
