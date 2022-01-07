<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoredefinition extends Model
{
    use HasFactory;

    protected $fillable = ['order_by', 'scorecategory','scorecomponent',];
}
