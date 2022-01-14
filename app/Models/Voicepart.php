<?php

namespace App\Models;

use App\Models\Utilities\FinalScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voicepart extends Model
{
    use HasFactory;

    public function adjudicators()
    {
        return $this->hasMany(Adjudicator::class);
    }

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    /**
     * @return string EnsembleName:VoicepartDescr
     */
    public function getFullDescrAttribute()
    {
        return $this->ensemble->descr.':'.$this->descr;
    }

    /**
     * Return array of audition results by grandtotal ascending with scoring details
     * @param Event $event
     * @param Ensemble $ensemble
     */
    public function results(Event $event, Ensemble $ensemble)
    {
       // $students = Student::where('event_id', $event->id)
       //     ->where('ensemble_id', $ensemble->id)
       //     ->where('voicepart_id', $this->id)
        //    ->pluck('id');

//dd(Student::where('event_id', $event->id)->where('ensemble_id', $ensemble->id)->where('voicepart_id', $this->id)->pluck('id'));
        /*
        $scores = Score::where('event_id', $event->id)
            //->select('student_id',DB::raw('sum(score) AS total'))
            ->whereIn('student_id', $students)
            ->where('ensemble_id', $ensemble->id)
            ->where('voicepart_id', $this->id)
          //  ->groupBy('student_id')
          //  ->orderBy('total')
            ->get();
        */
//[485,486,487,488,489,490,491,492,498,499,502,504,508,511,512,515,516,517,519,521,523,524,527,538,539,540,541,542,543,544]
        $scores = FinalScore::where('event_id',$event->id)
            ->where('ensemble_id', $ensemble->id)
            ->where('voicepart_id', $this->id)
            //->whereIn('student_id', [485,486,487,488,489,490,491,492,498,499,502,504,508,511,512,515,516,517,519,521,523,524,527,538,539,540,541,542,543,544])
            ->get();

        //$astudents = [];
        //foreach($scores AS $score){
        //    $astudents[] = $score->student_id;
        //}
        //[485,486,487,488,489,490,491,492,498,499]
       return $scores;
    }
}
