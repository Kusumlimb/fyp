<?php

namespace App\Enums;

enum Status: string
{
     case ACTIVE = 'active';
     case PENDING = 'pending';
     case REJECTED = 'rejected';

     public function label(): string
     {
          return match($this)
          {
               Status::ACTIVE => 'Active',
               Status::PENDING => 'Pending',
               Status::REJECTED => 'Rejected',
          };
     }
}
