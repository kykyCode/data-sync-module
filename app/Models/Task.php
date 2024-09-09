<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'project_external_id',
        'milestone_external_id',
        'employee_external_id',
        'title',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'created_at',
        'updated_at',
        'process_uuid'
    ];
}
