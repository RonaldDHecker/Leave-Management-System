<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilialObligation extends Model
{
    protected $fillable = [
        'compassionate_t_o_id',
        'reason',
        'name_of_parent',
        'name_of_sibling',
        
    ];

    public function compassionateTO(){
        return $this->belongsTo(CompassionateTO::class);
    }
    use HasFactory;
}
