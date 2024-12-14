<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
     use HasFactory;
     protected $fillable = [
          'quiz_id',
          'option_text',
          'is_correct',
     ];

     protected $casts = [
        'is_correct' => 'boolean',
     ];

     public function quiz() : BelongsTo
     {
          return $this->belongsTo(Quiz::class);
     }
}
