<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'leave_type',
        'within_phil',
        'abroad',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
