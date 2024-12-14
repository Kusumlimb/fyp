<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
     use HasFactory;
     protected $fillable = [
        'title',
        'course_id',
     ];

     public function course() : BelongsTo
     {
          return $this->belongsTo(Course::class);
     }

     public function options() : HasMany
     {
          return $this->hasMany(Option::class);
     }
}
