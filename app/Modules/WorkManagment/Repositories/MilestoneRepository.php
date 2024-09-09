<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Repositories;

use Carbon\Carbon;
use App\Models\Milestone;
use Illuminate\Support\Str;
use App\Domain\DTOs\MilestoneData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Collections\MilestoneDataCollection;

class MilestoneRepository
{
    /**
     * Create or update milestones based on the provided data.
     *
     * @param Collection $dataCollection
     * @param int $chunkSize
     */
    public function createOrUpdateMilestones(MilestoneDataCollection $dataCollection, int $chunkSize = 100): void
    {
        DB::beginTransaction();
        $process_uuid = Str::uuid();
        $now = Carbon::now();
        $dataCollection->getCollection()
            ->map(fn(MilestoneData $data) => [
                'external_id' => $data->externalId,
                'project_external_id' => $data->projectId,
                'title' => $data->title,
                'description' => $data->description,
                'start_date' => $data->startDate,
                'end_date' => $data->endDate,
                'status' => $data->status,
                'process_uuid' => $process_uuid,
                'created_at' => $now,
                'updated_at' => $now,
            ])->chunk($chunkSize)->each(function (Collection $chunk) {
                Milestone::query()->upsert(
                    $chunk->toArray(),
                    ['external_id'],
                    [
                        'project_external_id',
                        'title',
                        'description',
                        'start_date',
                        'end_date',
                        'status',
                        'process_uuid',
                        'updated_at'
                    ]
                );
            });

        DB::commit();
    }
}
