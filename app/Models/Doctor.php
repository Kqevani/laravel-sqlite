<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property int $years_of_experience
 * @property-read Collection<Specialization> $specializations
 * @property-read Collection<Doctor> $connections
 */
class Doctor extends Model
{
    protected $table = 'doctors';
    public $timestamps = false;

    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(
            Specialization::class,
            'doctors_specializations',
            'doctor_id',
            'specialization_id',
        );
    }

    public function connections(): BelongsToMany
    {
        return $this->belongsToMany(
            Doctor::class,
            'doctors_network',
            'doctor_1_id',
            'doctor_2_id',
        );
    }
}
