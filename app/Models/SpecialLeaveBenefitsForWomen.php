<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialLeaveBenefitsForWomen extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'leave_type',
        'slb_input',
        'slb_leave_attachment',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
