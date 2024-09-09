<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Repositories;

use Carbon\Carbon;
use App\Models\TimeLog;
use Illuminate\Support\Str;
use App\Domain\DTOs\TimeLogData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Collections\TimeLogDataCollection;

class TimeLogRepository {
    /**
     * Create or update time logs based on the provided data.
     *
     * @param Collection $dataCollection
     * @param int $chunkSize
     */
    public function createOrUpdateTimeLogs(TimeLogDataCollection $dataCollection, int $chunkSize = 100): void
    {
        DB::beginTransaction();
        $now = Carbon::now();

        $dataCollection->getCollection()
            ->map(fn(TimeLogData $data) => [
                'external_id' => $data->externalId,
                'task_external_id' => $data->taskId,
                'employee_external_id' => $data->employeeId,
                'hours_spent' => $data->hoursSpent,
                'created_at' => $now,
                'updated_at' => $now,
            ])->chunk($chunkSize)->each(function (Collection $chunk) {
                TimeLog::query()->upsert(
                    $chunk->toArray(),
                    ['external_id'],
                    [
                        'task_external_id',
                        'employee_external_id',
                        'hours_spent',
                        'updated_at'
                    ]
                );
            });

        DB::commit();
    }
}
