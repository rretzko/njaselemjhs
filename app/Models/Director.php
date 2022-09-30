<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'user_id';

    protected $with = ['user'];

    public function getCountCurrentStudentsAttribute() : int
    {
        $eventid = Event::currentEvent()->first()->id;

        return Student::where('user_id', $this->user_id)
            ->where('event_id', $eventid)
            ->count();
    }

    public function getCurrentStudentsAttribute()
    {
        $eventid = Event::currentEvent()->first()->id;

        return Student::where('user_id', $this->user_id)
            ->where('event_id', $eventid)
            ->orderBy('last')
            ->orderBy('first')
            ->get();
    }

    public function getFullnameAttribute()
    {
        return $this->first.' '.$this->last;
    }

    public function getFullnameAlphaAttribute()
    {
        return $this->last.', '.$this->first;
    }

    /**
     * Return first intial of ensembles in which $this
     * has students auditioning
     * i.e. E, J, or E/J
     * @return string
     */
    public function getHasStudentsInAttribute(): string
    {
        $elementary = $this->getStudentCountElementaryAttribute();

        $jhs = $this->getStudentCountJhsAttribute();

        if ($elementary && $jhs) {
            $has = 'E/J';
        } elseif ($elementary) {
            $has = 'E';
        }elseif($jhs){
            $has = 'J';
        }else{
            $has = '-';
        }

        return $has;
    }

    public function getStudentCountElementaryAttribute()
    {
        return Student::where('user_id', $this->user_id)
            ->where('event_id', Event::currentEvent()->first()->id)
            ->where('ensemble_id', 1)
            ->count();
    }

    public function getStudentCountJhsAttribute()
    {
        return Student::where('user_id', $this->user_id)
            ->where('event_id', Event::currentEvent()->first()->id)
            ->where('ensemble_id', 2)
            ->count();
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'user_id', 'user_id')
            ->orderBy('last')
            ->orderBy('first');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
