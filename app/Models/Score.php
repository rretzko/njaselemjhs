<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['adjudicator_id','ensemble_id','event_id','scoredefinition_id','student_id','score',
        'voicepart_id'];

    protected $with = ['scoredefinition'];

    public function studentScores(int $event_id, int $student_id): Collection
    {
        return Score::where('student_id', $student_id)
            ->where('event_id', $event_id)
            ->get()
            ->sortBy(['adjudicator_id','scoredefinition.order_by']);
    }

    public function scoredefinition()
    {
        return $this->hasOne(Scoredefinition::class, 'id', 'scoredefinition_id');
    }
}
