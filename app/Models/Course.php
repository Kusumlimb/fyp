<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
         'user_id',
        'title',
         'slug',
        'description',
         'price',
         'thumbnail'
    ];


    public function lessons() : HasMany
    {
         return $this->hasMany(Lesson::class);
    }

     public function quizzes() : HasMany
     {
         return $this->hasMany(Quiz::class);
     }

     public function instructor() : BelongsTo{
         return $this->belongsTo(User::class, 'user_id');
     }

     public function students() : BelongsToMany
     {
          return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id');
     }

}
