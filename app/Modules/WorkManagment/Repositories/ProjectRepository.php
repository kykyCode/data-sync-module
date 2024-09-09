<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Repositories;

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Domain\DTOs\ProjectData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Collections\ProjectDataCollection;

class ProjectRepository
{
    /**
     * Create or update projects based on the provided data.
     *
     * @param Collection $dataCollection
     * @param int $chunkSize
     */
    public function createOrUpdateProjects(ProjectDataCollection $dataCollection, int $chunkSize = 100): void
    {
        DB::beginTransaction();
        $process_uuid = Str::uuid();
        $now = Carbon::now();
        $dataCollection->getCollection()
            ->map(fn(ProjectData $data) => [
                'external_id' => $data->externalId,
                'name' => $data->name,
                'description' => $data->description,
                'start_date' => $data->startDate,
                'end_date' => $data->endDate,
                'status' => $data->status,
                'project_manager_external_id' => $data->projectManagerId,
                'process_uuid' => $process_uuid,
                'created_at' => $now,
                'updated_at' => $now,
            ])->chunk($chunkSize)->each(function (Collection $chunk) {
                Project::query()->upsert(
                    $chunk->toArray(),
                    ['external_id'],
                    [
                        'name',
                        'description',
                        'start_date',
                        'end_date',
                        'status',
                        'project_manager_external_id',
                        'process_uuid',
                        'updated_at'
                    ]
                );
            });

        DB::commit();
    }
}
