<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttemptAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_attempt_id', 'quiz_id', 'selected_option_id'];

    public function quizAttempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }
}

