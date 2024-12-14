<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];


    public function lessons() : HasMany
    {
         return $this->hasMany(Lesson::class);
    }

     public function quizzes() : HasMany
     {
         return $this->hasMany(Quiz::class);
     }

}
