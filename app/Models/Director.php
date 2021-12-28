<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'user_id';

    public function getFullnameAlphaAttribute()
    {
        return $this->last.', '.$this->first;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
