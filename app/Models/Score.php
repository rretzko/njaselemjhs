<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['adjudicator_id','ensemble_id','event_id','scoredefinition_id','student_id','score',
        'voicepart_id'];
}
