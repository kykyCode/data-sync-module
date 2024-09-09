<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'project_external_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
    ];
}
