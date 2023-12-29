<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VawcLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'leave_type',
        'vawc_leave_attachment',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
