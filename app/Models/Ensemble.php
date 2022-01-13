<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ensemble extends Model
{
    use HasFactory;

    public function adjudicators()
    {
        return $this->hasMany(Adjudicator::class);
    }

    /**
     * synonym for descr
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->descr;
    }

    public function rooms()
    {
        $rooms = collect();

        foreach($this->adjudicators AS $adjudicator){

            $rooms->push(Room::find($adjudicator->room_id));
        }

        return $rooms->unique();
    }

    public function voiceparts()
    {
        return $this->hasMany(Voicepart::class);
    }
}
