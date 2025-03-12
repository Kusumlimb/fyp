<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // ID of the sender
        'message',  // Chat message content
    ];

    /**
     * Relationship: A message belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
