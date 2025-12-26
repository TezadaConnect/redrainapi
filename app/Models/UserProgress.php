<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserProgress extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, Notifiable;

    protected $table = 'user_progress';

    protected $fillable = [
        'storyProgressId',
        'level',
        'experience',
        'coins',
        'gems',
    ];
}
