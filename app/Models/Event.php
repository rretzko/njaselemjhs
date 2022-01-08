<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['end_date', 'name','short_name','start_date',];

    public function adjudicators()
    {
        return $this->hasMany(Adjudicator::class)
            ->where('event_id', $this->id);
    }

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class);
    }

    public function getAdjudicatorCandidatesAttribute()
    {
        $userids = Student::where('created_at','>=', $this->start_date)
            ->where('created_at', '<=', $this->end_date)
            ->pluck('user_id')
            ->toArray();

        return Director::find($userids)->sortBy('fullnameAlpha');
    }

    public static function currentEvent()
    {
        return Event::all()->filter(function($event){
            return (($event->start_date <= now()) && ($event->end_date >= now()));
        });

    }

    public function getEndDateYyyyMmDdAttribute()
    {
        return substr($this->end_date,0,10);
    }

    public function getStartDateYyyyMmDdAttribute()
    {
        return substr($this->start_date,0,10);
    }

    public function getEndDateMmmDdYyyyAttribute()
    {
        return date('M j, Y',strtotime($this->end_date));
    }

    public function getStartDateMmmDdYyyyAttribute()
    {
        return date('M j, Y',strtotime($this->start_date));
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
