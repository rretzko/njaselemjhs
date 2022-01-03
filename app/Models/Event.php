<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['end_date', 'name','short_name','start_date',];

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class);
    }

    public function getEndDateYyyyMmDdAttribute()
    {
        return substr($this->end_date,0,10);
    }

    public function getStartDateYyyyMmDdAttribute()
    {
        return substr($this->start_date,0,10);
    }

    public function getEndDateMmmDdYyyyAttribute()
    {
        return date('M j, Y',strtotime($this->end_date));
    }

    public function getStartDateMmmDdYyyyAttribute()
    {
        return date('M j, Y',strtotime($this->start_date));
    }
}
