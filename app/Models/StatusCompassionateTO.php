<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCompassionateTO extends Model
{
    use HasFactory;


    protected $fillable = [
        'compassionate_t_o_id',
        'admin',
        'head',
    ];

    public function compassionateTO(){
        return $this->belongsTo(CompassionateTO::class);
    }

}
