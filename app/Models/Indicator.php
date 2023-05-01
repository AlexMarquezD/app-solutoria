<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $table = 'indicators';
    
    protected $fillable = [
        'name_indicator',
        'code_indicator',
        'unit_measure_indicator',
        'value',
        'date_indicator',
        'time_indicator',
        'origin_indicator',
    ]; 
}
