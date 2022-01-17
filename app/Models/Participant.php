<?php

namespace App\Models;

use App\Models\Utilities\FinalScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id','event_id','student_id','voicepart_id'];

    public function getFinalScoreAttribute()
    {
        return FinalScore::where('student_id', $this->student_id)
            ->where('event_id', $this->event_id)
            ->where('ensemble_id', $this->ensemble_id)
            ->where('voicepart_id', $this->voicepart_id)
            ->value('score');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function updateParticipants(Event $event, Ensemble $ensemble, Voicepart $voicepart)
    {
        $event_id = $event->id;
        $ensemble_id = $ensemble->id;
        $voicepart_id = $voicepart->id;

        //delete current participants
        Participant::where('event_id', $event_id)
            ->where('ensemble_id', $ensemble_id)
            ->where('voicepart_id', $voicepart_id)
            ->delete();

        //find cutoff
        $cutoff = Cutoff::where('event_id', $event_id)
            ->where('ensemble_id', $ensemble_id)
            ->where('voicepart_id', $voicepart_id)
            ->pluck('score');

        //find students with final score <= $cutoff
        $students = FinalScore::where('event_id', $event_id)
            ->where('ensemble_id', $ensemble_id)
            ->where('voicepart_id', $voicepart_id)
            ->where('score', '<=', $cutoff)
            ->pluck('student_id');

        //add participants
        foreach($students AS $student_id){
            Participant::create([
                'event_id' => $event_id,
                'ensemble_id' => $ensemble_id,
                'voicepart_id' => $voicepart_id,
                'student_id' => $student_id,
            ]);
        }
    }

    public function voicepart()
    {
        return $this->belongsTo(Voicepart::class);
    }
}
