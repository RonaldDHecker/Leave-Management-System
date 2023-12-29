<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnteMortem extends Model
{
    protected $fillable = [
        'compassionate_t_o_id',
        'reason',
        'immediate_family_member',
        'doc_cert',
    ];

    public function compassionateTO(){
        return $this->belongsTo(CompassionateTO::class, 'compassionate_t_o_id');
    }
    use HasFactory;
}
