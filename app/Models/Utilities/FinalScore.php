<?php

namespace App\Models\Utilities;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalScore extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id','event_id','score', 'student_id', 'voicepart_id'];

    public function updateFinalScore(Student $student, int $score)
    {
        $this->updateOrCreate(
            [
                'event_id' => $student->event_id,
                'ensemble_id' => $student->ensemble_id,
                'voicepart_id' => $student->voicepart_id,
                'student_id' => $student->id,
            ],
            [
                'score' => $score,
            ]
        );
    }
}
