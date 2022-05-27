<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goals extends Model
{
    protected $table = 'goals';
    protected $fillable = ['goal_name', 'goal_process', 'goal_status', 'goal_unique_code', 'created_by', 'created_by_name'];
}
