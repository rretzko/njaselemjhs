<?php

namespace App\Models;

use App\Models\Utilities\FinalScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public function calcFinalScore()
    {
        $fullset = 15;
        $finalscore = new FinalScore;

        //add or update row if a full set of scores is available
        if(Score::where('student_id', $this->id)->count() === $fullset){

            $finalscore->updateFinalScore($this, Score::where('student_id', $this->id)->sum('score'));
        }

    }

    public function director()
    {
        return $this->belongsTo(Director::class, 'user_id', 'user_id');
    }

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    public function getAdjudicatorsAttribute(): Collection
    {
        return Adjudicator::where('event_id', Event::currentEvent()->first()->id)
            ->where('voicepart_id',$this->voicepart_id)
            ->get();
    }

    public function getEnsembleNameAttribute()
    {
        return $this->ensemble->descr;
    }

    /**
     * Designed for situations where the same adjudicator judges multiple voice parts
     * This method returns the correct adjudicator row for $this student's voice part
     *
     * @return mixed
     */
    public function getEventAdjudicatorAttribute()
    {
         return Adjudicator::where('event_id', Event::currentEvent()->first()->id)
            ->where('voicepart_id', $this->voicepart_id)
            ->where('user_id', auth()->id())
            ->first();
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

        //early exit student's teacher is $this
        if($this->user_id === auth()->id()){return 'rgba(0,0,0,.3';}

        //early exit
        if(! $scorescount){ return 'rgba(0,0,255,.1)';} //indigo-50;

        if($scorescount < $fullcount){ return 'rgba(255,255,159,.5)';} //yellow

        if(($scorescount === $fullcount) && $this->tolerance()){ return 'rgba(0,255,0,.1';} //green

        return 'rgba(255,0,0,.1)'; //red
    }

    public function getVoicepartAbbrAttribute()
    {
        return $this->voicepart->abbr;
    }

    public function getVoicepartDescrAttribute()
    {
        return $this->voicepart->descr;
    }

    public function getScoresAttribute()
    {
        return Score::where('student_id', $this->id)->get();
    }

    /**
     * For instances where $this teacher is on the adjudication board,
     * provide an average of the other adjudicators for the teacher's scores
     */
    public function logAverageScore()
    {
        //total other-adjudication scores
        $otherscores = 10;

        $scores = $this->scores;

        //student's teacher adjudicator object
        $teacheradjudicator = Adjudicator::where('user_id', $this->user_id)->first();

        //proceed if the other adjudicators has complete sets of scores logged
        if($scores->count() >= $otherscores){

            //find one Adjudicator
            $searchadjudicator = Adjudicator::find($scores[0]->adjudicator_id);

            //array of averaged scores
            $avgdscores = [];
            for($i=1;$i<6;$i++) {

                //find the scores for the scoredefinition_id (as $i) other than the student's teacher
                $scores = Score::where('student_id', $this->id)
                    ->where('adjudicator_id', '<>', $teacheradjudicator->id)
                    ->where('scoredefinition_id', $i)
                    ->pluck('score');

                //average the found scores, rounding down and log the integer value
                $avgdscores[] = (int)floor((($scores[0] + $scores[1])/$scores->count()));
            }

            //update the db for the student's teacher with the averaged scores
            foreach($avgdscores AS $key => $avgdscore){

                Score::updateOrCreate(
                    [
                        'student_id' => $this->id,
                        'voicepart_id' => $this->voicepart_id,
                        'event_id' => $teacheradjudicator->event_id,
                        'adjudicator_id' => $teacheradjudicator->id,
                        'ensemble_id' => $searchadjudicator->ensemble_id,
                        'scoredefinition_id' => ($key + 1),
                    ],
                    [
                        'score' => $avgdscore,
                    ]
                );
            }
        }
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
