<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scorecategory extends Model
{
    use HasFactory;

    public function scorecomponents()
    {
        return $this->belongsToMany(Scorecomponent::class)
            ->withPivot('order_by');
    }
}
