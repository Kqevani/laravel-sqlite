<?php

namespace App\Repositories\Doctor;

use App\Models\Doctor;
use Illuminate\Support\Collection;

interface DoctorRepositoryInterface
{
    public function getReachable(Doctor $start): Collection;
    public function getReachableBySpecialization(Doctor $start, string $specialization): Collection;
}
