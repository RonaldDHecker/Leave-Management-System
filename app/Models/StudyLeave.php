<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyLeave extends Model
{
    use HasFactory;
    protected $fillable = [
        'leave_id',
        'leave_type',
        'study_choice',
        'study_leave_attachment',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
