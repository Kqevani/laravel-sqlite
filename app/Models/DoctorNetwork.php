<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $doctor_1_id
 * @property int $doctor_2_id
 */
class DoctorNetwork extends Pivot
{
    protected $table = 'doctors_network';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['doctor_1_id', 'doctor_2_id'];
}
