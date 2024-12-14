<?php
if (!function_exists('getInitials')) {
     function getInitials(string $name) : string
     {
          $words = explode(' ', $name);
          $initials = '';
          foreach ($words as $word) {
               $initials .= strtoupper($word[0]);
          }
          return $initials;
     }
}