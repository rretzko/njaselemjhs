<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adjudicator extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id','event_id','room_id','user_id','voicepart_id'];

    public function director()
    {
        return $this->belongsTo(Director::class, 'user_id', 'user_id');
    }

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getFullnameAlphaAttribute(): string
    {
        return $this->director->fullnameAlpha;
    }

    public function getShortNameAlphaAttribute(): string
    {
        return substr($this->director->fullnameAlpha,0,12);
    }

    public function scoreArray(Student $student): array
    {
        $scores =  DB::table('scores')
            ->where('student_id', $student->id)
            ->where('adjudicator_id', $this->id)
            ->where('event_id', Event::currentEvent()->first()->id)
            ->pluck('score')
            ->toArray();

        return count($scores)
            ? [
                $scores[0], //Vocalese Vocal Quality
                $scores[1], //Vocalese Intonation
                ($scores[0] + $scores[1]), //Vocalese Total
                $scores[2], //Solo Vocal Quality
                $scores[3], //Solo Intonation
                $scores[4], //Solo Musicianship
                ($scores[2] + $scores[3] + $scores[4]), //Solo Total
                array_sum($scores), //All Scores Total
              ]
            : [0,0,0,0,0,0,0,0];
    }

    /**
     * Return true if panel to which $this belongs includes $student teacher
     * @todo add event_id conditional
     * @param Student $student
     * @return bool
     */
    public function panelHasStudentsTeacher(Student $student)
    {
        return $this->room->adjudicators->contains(Adjudicator::where('user_id', $student->user_id)->first());
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function students()
    {
        return Student::where('event_id', Event::currentEvent()->first()->id)
            ->where('ensemble_id', $this->ensemble_id)
            ->whereIn('voicepart_id', $this->voiceparts())
            ->get()
            ->sortBy('voicepart_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voicepart()
    {
        return $this->belongsTo(Voicepart::class);
    }

    /*
     * An adjudicator can be assigned to multiple voiceparts
     */
    private function voiceparts()
    {
        return Adjudicator::where('user_id', $this->user_id)
            ->where('event_id', Event::currentEvent()->first()->id)
            ->where('ensemble_id', $this->ensemble_id)
            ->pluck('voicepart_id')
            ->toArray();
    }

}
