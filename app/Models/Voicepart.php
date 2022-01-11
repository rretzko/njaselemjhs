<?php

namespace App\Models;

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
        return Score::where('event_id', $event->id)
            ->select('student_id',DB::raw('sum(score) AS total'))
            ->where('ensemble_id', $ensemble->id)
            ->where('voicepart_id', $this->id)
            ->groupBy('student_id')
            ->orderBy('total')
            ->get();
    }
}
