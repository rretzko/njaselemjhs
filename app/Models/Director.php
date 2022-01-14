<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'user_id';

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
