<?php

namespace App\Enums;

enum Role: string
{
     case STUDENT = 'student';
     case ADMIN = 'admin';
     case TEACHER = 'teacher';

     public function label(): string
     {
          return match($this)
          {
               Role::STUDENT => 'Student',
               Role::ADMIN => 'Admin',
               Role::TEACHER => 'Teacher',
          };
     }
}
