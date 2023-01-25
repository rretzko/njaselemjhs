<?php

namespace App\Models\Utilities;

use App\Models\Adjudicator;
use App\Models\Cutoff;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Score;
use App\Models\Student;
use App\Models\Voicepart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FinalScore extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id','event_id','score', 'student_id', 'voicepart_id'];

    public function getIsAcceptedAttribute(): bool
    {
        $cutoff = Cutoff::where('event_id', $this->event_id)
            ->where('ensemble_id', $this->ensemble_id)
            ->where('voicepart_id', $this->student->voicepart_id)
            ->first()
            ->score ?? 0;

        return $this->score <= $cutoff;
    }

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
     * Replace averaged scores with dashes when student's teacher is also student's adjudicator
     * @return void
     */
    public function getStudentScoresAttribute() : array
    {
        /**
         * @since 25-Jan-23
         */
        $eventId = Event::currentEvent()->first()->id;
        $teacherId = Student::find($this->student_id)->user_id;
        $adjudicator = Adjudicator::where('user_id', $teacherId)->where('event_id', $eventId)->first();
        $adjudicatorId = ($adjudicator) ? $adjudicator->id : 0;
        $score = new Score;
        foreach($score->studentScores(Event::currentEvent()->first()->id, $this->student_id) AS $studentScore){
            $studentScores[] = ($studentScore->adjudicator_id == $adjudicatorId)
                ? '-'
                : $studentScore->score;
        }

        return $studentScores ?: [0,0,0,0,0,0,0];

        /**
         * @since 21-Jan-23
         */
        /*
        $scores = DB::table('scores')
            ->join('scoredefinitions', 'scores.scoredefinition_id','=','scoredefinitions.id')
            ->where('scores.student_id', $this->student_id)
            ->where('scores.event_id', Event::currentEvent()->first()->id)
            ->orderBy('scores.adjudicator_id')
            ->orderBy('scoredefinitions.order_by')
            ->pluck('scores.score')
            ->toArray();

        return $scores;
        */

        /**
         * @since 2021-22
         */
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
