<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutoff extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id', 'event_id','score', 'voicepart_id'];

    public function cutoffs(Event $event, Ensemble $ensemble)
    {
        return $this->where('event_id', $event->id)->where('ensemble_id', $ensemble->id)->get();
    }
}
