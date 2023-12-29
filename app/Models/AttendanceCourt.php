<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCourt extends Model
{
    protected $fillable = [
        'compassionate_t_o_id',
        'reason',
        'court_cert',
    ];

    public function compassionateTO(){
        return $this->belongsTo(CompassionateTO::class);
    }
    use HasFactory;
}
