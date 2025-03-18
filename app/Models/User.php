<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;

class User extends Authenticatable
{

     use HasFactory, Notifiable;

     /**
      * The attributes that are mass assignable.
      *
      * @var array<int, string>
      */
     protected $fillable = [
          'name',
          'email',
          'password',
          'role',
     ];

     /**
      * The attributes that should be hidden for serialization.
      *
      * @var array<int, string>
      */
     protected $hidden = [
          'password',
          'remember_token',
     ];

     /**
      * Get the attributes that should be cast.
      *
      * @return array<string, string>
      */
     protected function casts() : array
     {
          return [
               'email_verified_at' => 'datetime',
               'password'          => 'hashed',
               'role'              => Role::class,
          ];
     }

     /**
      * Role-based access helper methods.
      */
     public function isAdmin() : bool
     {
          return $this->role === Role::ADMIN;
     }

     public function isTeacher() : bool
     {
          return $this->role === Role::TEACHER;
     }

     public function isStudent() : bool
     {
          return $this->role === Role::STUDENT;
     }

     public function enrolledCourses() : BelongsToMany
     {
          return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id');
     }

     public function createdCourses() : HasMany
     {
          return $this->hasMany(Course::class, 'user_id', 'id');
     }

     public function comments() {
          return $this->hasMany(Comment::class);
      }

      
      
      
}
