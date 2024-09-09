<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Repositories;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Support\Str;
use App\Domain\DTOs\EmployeeData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Collections\EmployeeDataCollection;

class EmployeeRepository {
    
    public function createOrUpdateEmployees(EmployeeDataCollection $dataCollection, int $chunkSize = 100): void
    {
        DB::beginTransaction();
        $process_uuid = Str::uuid();
        $now = Carbon::now();
        $dataCollection->getCollection()
            ->map(fn(EmployeeData $data) => [
                'external_id'=>$data->externalId,
                'name' => $data->name,
                'email' => $data->email,
                'role' => $data->role,
                'phone'=> $data->phone,
                'emergency_contact'=>$data->emergencyContact,
                'process_uuid'=>$process_uuid,
                'created_at'=>$now,
                'updated_at'=>$now
            ])
            ->chunk($chunkSize)
            ->each(
                function(Collection $chunk){
                    Employee::query()
                        ->upsert(
                            $chunk->toArray(),
                            ['external_id'],
                            [
                                'name',
                                'email',
                                'role',
                                'phone',
                                'emergency_contact',
                                'process_uuid',
                                'updated_at'
                            ]
                            );
                }
            );
            DB::commit();
    }
}