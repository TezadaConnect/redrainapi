<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserInfo extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, Notifiable;

    // Table name (optional if following Laravel naming conventions)
    protected $table = 'user_infos';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'gender',
        'phone',
        'story_progress_id',
    ];

    /**
     * The user this info belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Optional: If you have a StoryProgress model for story_progress_id
     */
    // public function storyProgress()
    // {
    //     return $this->belongsTo(StoryProgress::class, 'story_progress_id');
    // }
}
