<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scorecomponent extends Model
{
    use HasFactory;

    public function scorecategories()
    {
        return $this->belongsToMany(Scorecategory::class)
            ->withPivot('order_by');
    }
}
