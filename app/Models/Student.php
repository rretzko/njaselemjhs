<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    public function voicepart()
    {
        return $this->belongsTo(Voicepart::class);
    }

    public function getVoicepartDescrAttribute()
    {
        return $this->voicepart->descr;
    }


}
