<?php

namespace App\Services;

use App\Models\Doctor;
use App\Repositories\Doctor\DoctorRepositoryInterface;
use Illuminate\Support\Collection;

class DoctorNetworkService
{
    public function __construct(protected DoctorRepositoryInterface $repository)
    {
    }

    public function aggregateNetwork(
        Doctor $doctor,
        string $specialization,
        ?int $minYoe = null,
        ?int $maxYoe = null
    ): array {
        $hasYoeFilter = $minYoe !== null || $maxYoe !== null;

        $reachable = $this->repository->getReachableBySpecialization($doctor, $specialization);

        if ($hasYoeFilter) {
            $reachable = $this->applyYoeFilter($reachable, $minYoe, $maxYoe);
        }

        $data = [
            // aggregrates is mispelled here
            'specializations_aggregrates' => $this->aggregateSpecializations($reachable),
        ];

        if ($hasYoeFilter) {
            $data['years_of_experience_aggregates'] = $this->aggregateYoe($reachable);
        }

        return $data;
    }

    protected function applyYoeFilter(Collection $docs, ?int $min, ?int $max): Collection
    {
        return $docs->filter(fn(Doctor $doc) =>
            ($min === null || $doc->years_of_experience >= $min) &&
            ($max === null || $doc->years_of_experience <= $max)
        );
    }

    protected function aggregateSpecializations(Collection $docs): array
    {
        return $docs
            ->flatMap(fn(Doctor $doc) =>
            $doc->specializations()
                ->pluck('specialization')
                ->toArray()
            )
            ->countBy()
            ->sortKeys()
            ->toArray();
    }

    protected function aggregateYoe(Collection $docs): array
    {
        return $docs
            ->pluck('years_of_experience')
            ->countBy()
            ->sortKeys()
            ->toArray();
    }
}
