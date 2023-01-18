<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getAdjudicatorsWithVoiceAbbrAttribute(): array
    {
        $eventId = Event::currentEvent()->first()->id;
        $userIds = DB::table('adjudicators')
            ->where('room_id', $this->id)
            ->where('event_id', $eventId)
            ->distinct('user_id')
            ->pluck('user_id');

        $a = [];
        foreach(Director::find($userIds) AS $director){

            $row = $director->fullnameAlpha. ' (';
            $row .= $this->adjudicatorVoicePartsCSV($director, $eventId);
            $row .= ')';

            $a[] = [
                'alpha' => $director->fullnameAlpha,
                'string' => $row,
                ];
        }
        sort($a);

        return array_column($a, 'string');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    private function adjudicatorVoicePartsCSV(Director $director, int $eventId): string
    {
        $voiceparts = DB::table('adjudicators')
            ->join('voiceparts', 'adjudicators.voicepart_id', '=', 'voiceparts.id')
            ->where('room_id', $this->id)
            ->where('event_id', $eventId)
            ->where('user_id', $director->user_id)
            ->pluck('voiceparts.abbr')
            ->toArray();

        return implode(',', $voiceparts);
    }
}
