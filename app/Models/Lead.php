<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'industry',
        'budget',
        'source',
        'status',
        'score',
        'requirements',
        'ai_summary',
    ];
}