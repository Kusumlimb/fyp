<?php

namespace App\Enums;

enum Role: string
{
     case STUDENT = 'student';
     case ADMIN = 'admin';
     case TEACHER = 'teacher';
}
