<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
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

    public function vacationLeave(){
        return $this->hasOne(VacationLeave::class);
    }

    public function mandatoryLeave(){
        return $this->hasOne(MandatoryLeave::class);
    }

    public function sickLeave(){
        return $this->hasOne(SickLeave::class);
    }

    public function maternityLeave(){
        return $this->hasOne(MaternityLeave::class);
    }

    public function paternityLeave(){
        return $this->hasOne(PaternityLeave::class);
    }

    public function specialPrivilegeLeave(){
        return $this->hasOne(SpecialPrivilegeLeave::class);
    }

    public function soloParentLeave(){
        return $this->hasOne(SoloParentLeave::class);
    }

    public function studyLeave(){
        return $this->hasOne(StudyLeave::class);
    }

    public function vawcLeave(){
        return $this->hasOne(VawcLeave::class);
    }

    public function rehabilitationLeave(){
        return $this->hasOne(RehabilitationLeave::class);
    }

    public function specialLeaveBenefitsForWomen(){
        return $this->hasOne(SpecialLeaveBenefitsForWomen::class);
    }

    public function calamityLeave(){
        return $this->hasOne(CalamityLeave::class);
    }

    public function adoptionLeave(){
        return $this->hasOne(AdoptionLeave::class);
    }

    public function statusLeave(){
        return $this->hasOne(StatusLeave::class);
    }

}
