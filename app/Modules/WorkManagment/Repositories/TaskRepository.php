<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Repositories;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Str;
use App\Domain\DTOs\TaskData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Collections\TaskDataCollection;

class TaskRepository {
    /**
     * Create or update tasks based on the provided data.
     *
     * @param Collection $dataCollection
     * @param int $chunkSize
     */
    public function createOrUpdateTasks(TaskDataCollection $dataCollection, int $chunkSize = 100): void
    {
        DB::beginTransaction();
        $process_uuid = Str::uuid();
        $now = Carbon::now();
        $dataCollection->getCollection()
            ->map(fn(TaskData $data) => [
                'external_id' => $data->externalId,
                'title' => $data->title,
                'milestone_external_id' => $data->milestoneId,
                'employee_external_id' => $data->employeeId,
                'project_external_id' => $data->projectId,
                'description' => $data->description,
                'start_date' => $data->startDate,
                'due_date' => $data->dueDate,
                'priority' => $data->priority,
                'status' => $data->status,
                'process_uuid' => $process_uuid,
                'created_at' => $now,
                'updated_at' => $now,
            ])->chunk($chunkSize)->each(function (Collection $chunk) {
                Task::query()->upsert(
                    $chunk->toArray(),
                    ['external_id'],
                    [
                        'title',
                        'milestone_external_id',
                        'project_external_id',
                        'employee_external_id',
                        'description',
                        'start_date',
                        'due_date',
                        'status',
                        'process_uuid',
                        'updated_at'
                    ]
                );
            });

        DB::commit();
    }
}