<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function adjudicators()
    {
        $currentEventId = Event::currentEvent()->first()->id;

        return $this->hasMany(Adjudicator::class)
            ->where('event_id', $currentEventId);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
