<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return (Adjudicator::where('user_id', $this->user_id)
            ->where('room_id', $this->room_id)
            ->where('event_id', $this->event_id)
            ->where('ensemble_id', $this->ensemble_id)
            ->pluck('voicepart_id')
            ->toArray());
    }

}
