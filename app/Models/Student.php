<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function adjudicatorTotal(Adjudicator $adjudicator)
    {
        $total = 0;

        foreach($this->scoresByAdjudicator($adjudicator) AS $score){
            $total += $score->score;
        }

        return $total;
    }

    public function director()
    {
        return $this->belongsTo(Director::class, 'user_id', 'user_id');
    }

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    public function getEnsembleNameAttribute()
    {
        return $this->ensemble->descr;
    }

    public function getFullnameAttribute()
    {
        return $this->first.' '.$this->last;
    }

    public function getFullnameAlphaAttribute()
    {
        return $this->last.', '.$this->first;
    }

    public function getSchoolNameAttribute()
    {
        return $this->director->school;
    }

    public function getToleranceBackgroundColorAttribute()
    {
        $fullcount = 15;

        $scorescount = $this->scores->count();

        //early exit
        if(! $scorescount){ return 'rgba(0,0,255,.1)';} //indigo-50;

        if($scorescount < $fullcount){ return 'rgba(255,255,159,.5)';} //yellow

        if(($scorescount === $fullcount) && $this->tolerance()){ return 'rgba(0,255,0,.1';} //green

        return 'rgba(255,0,0,.1)'; //red
    }

    public function getVoicepartDescrAttribute()
    {
        return $this->voicepart->descr;
    }

    public function getScoresAttribute()
    {
        return Score::where('student_id', $this->id)->get();
    }

    public function scoresByAdjudicator(Adjudicator $adjudicator)
    {
        return Score::where('student_id', $this->id)
            ->where('adjudicator_id', $adjudicator->id)
            ->where('ensemble_id', $adjudicator->ensemble_id)
            ->get();
    }

    public function tolerance()
    {
        $tolerance = 10;

        $scores = Score::groupBy('adjudicator_id')
            ->where('student_id', $this->id)
            ->selectRaw('sum(score) AS total, adjudicator_id')
            ->orderBy('total')
            ->pluck('total');

        return (($scores[2] - $scores[0]) <= $tolerance);
    }

    public function voicepart()
    {
        return $this->belongsTo(Voicepart::class);
    }




}
