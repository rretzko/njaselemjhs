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
        return $this->hasMany(Adjudicator::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
