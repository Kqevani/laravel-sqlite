<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $specialization
 * @property-read Collection<Doctor> $doctors
 */
class Specialization extends Model
{
    protected $table = 'specializations';
    public $timestamps = false;

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(
            Doctor::class,
            'doctors_specializations',
            'specialization_id',
            'doctor_id'
        );
    }
}
