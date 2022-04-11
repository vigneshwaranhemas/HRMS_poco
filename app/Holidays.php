<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    protected $table = 'holidays';
    protected $fillable = ['occassion', 'date', 'created_by'];
}
