<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'task_external_id',
        'employee_external_id',
        'hours_spent',
        'created_at',
        'updated_at',
        'process_uuid'
    ];
}
