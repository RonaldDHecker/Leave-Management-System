<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompassionateTO extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'date1',
        'date2',
        'date3',
        'leave_days',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function filialObligation(){
        return $this->hasOne(FilialObligation::class);
    }
    
    public function familyReunion(){
        return $this->hasOne(FamilyReunion::class);
    }

    public function deathAnniversary(){
        return $this->hasOne(DeathAnniversary::class);
    }

    public function anteMortem(){
        return $this->hasOne(AnteMortem::class);
    }

    public function attendanceCourt(){
        return $this->hasOne(AttendanceCourt::class);
    }

    public function statusCompassionateTO(){
        return $this->hasOne(StatusCompassionateTO::class);
    }

    
}
