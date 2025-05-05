<?php

namespace App\Repositories\Doctor;

use App\Models\Doctor;
use Illuminate\Support\Collection;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function getReachable(Doctor $start): Collection
    {
        $visited   = collect([$start->id]);
        $queue     = new \SplQueue();
        $queue->enqueue(
            $start->load(['specializations', 'connections.specializations', 'connections.connections'])
        );
        $collected = collect();

        while (!$queue->isEmpty()) {
            /** @var Doctor $current */
            $current = $queue->dequeue();
            $collected->push($current);

            foreach ($current->connections as $neighbor) {
                if (!$visited->contains($neighbor->id)) {
                    $visited->push($neighbor->id);
                    $queue->enqueue($neighbor->load(['specializations', 'connections']));
                }
            }
        }

        return $collected;
    }

    public function getReachableBySpecialization(Doctor $start, string $specialization): Collection
    {
        return $this->getReachable($start)
            ->filter(fn(Doctor $doc) =>
            $doc->specializations()
                ->pluck('specialization')
                ->contains($specialization)
            );
    }
}
