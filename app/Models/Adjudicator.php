<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjudicator extends Model
{
    use HasFactory;

    protected $fillable = ['ensemble_id','event_id','room_id','user_id','voicepart_id'];

    public function director()
    {
        return $this->belongsTo(Director::class, 'user_id', 'user_id');
    }

    public function ensemble()
    {
        return $this->belongsTo(Ensemble::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function students()
    {
        return Student::where('voicepart_id', $this->voicepart_id)
            ->where('ensemble_id', $this->ensemble_id)
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voicepart()
    {
        return $this->belongsTo(Voicepart::class);
    }

}
