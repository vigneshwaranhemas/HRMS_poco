<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';
    protected $fillable = [
        'event_name', 
        'label_color', 
        'where', 
        'description', 
        'start_date_time', 
        'end_date_time', 
        'repeat', 
        'repeat_every', 
        'repeat_cycles', 
        'repeat_type', 
        'category_name', 
        'event_type', 
        'code', 
        'candicate_list',
    ];
}
