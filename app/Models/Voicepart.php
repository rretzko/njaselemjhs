<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
