<?php

namespace App\Models\Utilities;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Student;
use App\Models\Voicepart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FinalScore extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id','event_id','score', 'student_id', 'voicepart_id'];

    public function getIsParticipantAttribute()
    {
        return Student::where('id', $this->student_id)
            ->where('ensemble_id', $this->ensemble_id)
            ->where('event_id', $this->event_id)
            ->where('voicepart_id', $this->voicepart_id)
            ->exists();
        /*
        return Participant::where('student_id', $this->student_id)
            ->where('ensemble_id', $this->ensemble_id)
            ->where('event_id', $this->event_id)
            ->where('voicepart_id', $this->voicepart_id)
            ->exists();
        */
    }

    /**
     * Return array of scores sorted by adjudicator_id + scoredefinition->order_by
     * @return void
     */
    public function getStudentScoresAttribute() : array
    {
        $scores = DB::table('scores')
            ->join('scoredefinitions', 'scores.scoredefinition_id','=','scoredefinitions.id')
            ->where('scores.student_id', $this->student_id)
            ->where('scores.event_id', Event::currentEvent()->first()->id)
            ->orderBy('scores.adjudicator_id')
            ->orderBy('scoredefinitions.order_by')
            ->pluck('scores.score')
            ->toArray();

        return $scores ?: [0,0,0,0,0,0,0];
        /*
        return Student::find($this->student_id)->scores
            ->sortBy('adjudicator_id')
            ->sortBy('scoredefinition_id');
        */
    }

    public function getVoicepartAbbrAttribute()
    {
        return Voicepart::find($this->voicepart_id)->abbr;
    }

    public function getVoicepartDescrAttribute()
    {
        return Voicepart::find($this->voicepart_id)->descr;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

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
