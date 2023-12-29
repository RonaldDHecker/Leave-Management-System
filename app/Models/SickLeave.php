<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SickLeave extends Model
{
    use HasFactory;
    protected $fillable = [
        'leave_id',
        'leave_type',
        'sick_choice',
        'sick_input',
        'sick_leave_attachment',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
