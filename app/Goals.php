<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goals extends Model
{
    protected $table = 'goals';
    protected $fillable = [
        'goal_name', 
        'goal_process', 
        'goal_status', 
        'supervisor_status',
        'reviewer_status',
        'hr_status',
        'bh_status',
        'employee_summary',
        'supervisor_summary',
        'goal_unique_code', 
        'created_by', 
        'created_by_name'
    ];
}
