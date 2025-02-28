<?php

namespace App\Models;

use App\Models\Scopes\OrderLessonByPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Lesson extends Model
{
     use HasSlug;
    protected $fillable = [
        'course_id',
        'title',
         'slug',
         'order',
        'description',
        'video_url',
         'duration',
    ];

     protected static function booted() : void
     {
          static::addGlobalScope(new OrderLessonByPosition());
     }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

     public function getSlugOptions() : SlugOptions
     {
          return SlugOptions::create()
               ->generateSlugsFrom('title')
               ->saveSlugsTo('slug')
               ->doNotGenerateSlugsOnUpdate();
     }

}
