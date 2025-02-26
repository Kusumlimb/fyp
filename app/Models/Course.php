<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Course extends Model
{
     use HasSlug;

    protected $fillable = [
         'user_id',
         'title',
         'slug',
         'description',
         'price',
         'status',
         'thumbnail'
    ];

    protected $casts = [
         'status' => Status::class,
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

     public function getSlugOptions() : SlugOptions
     {
          return SlugOptions::create()
               ->generateSlugsFrom('title')
               ->saveSlugsTo('slug')
               ->doNotGenerateSlugsOnUpdate();
     }

}
