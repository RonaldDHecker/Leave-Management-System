<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'admin',
        'head',
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }
}
