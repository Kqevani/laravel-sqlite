<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorNetworkRequest;
use App\Models\Doctor;
use App\Services\DoctorNetworkService;
use Illuminate\Http\JsonResponse;

class DoctorNetworkController extends Controller
{
    public function __construct(protected DoctorNetworkService $networkService)
    {
    }

    public function aggregates(
        DoctorNetworkRequest $request,
        Doctor $doctor
    ): JsonResponse {
        $filters = $request->validated();

        $data = $this->networkService->aggregateNetwork(
            doctor: $doctor,
            specialization: $filters['specialization'],
            minYoe: $filters['min_yoe'] ?? null,
            maxYoe: $filters['max_yoe'] ?? null,
        );

        return response()->json($data);
    }
}
