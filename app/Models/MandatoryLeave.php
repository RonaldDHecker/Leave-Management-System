<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MandatoryLeave extends Model
{
    use HasFactory;
    protected $fillable = [
        'leave_id',
        'leave_type',
        'phil',
        'international',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
