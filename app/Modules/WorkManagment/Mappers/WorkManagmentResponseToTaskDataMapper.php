<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Mappers;

use App\Domain\DTOs\TaskData;
use App\Domain\Mappers\DataCollectionMapper;
use App\Domain\Collections\TaskDataCollection;

class WorkManagmentResponseToTaskDataMapper extends DataCollectionMapper{
    public function map(iterable $data): TaskDataCollection
    {
        foreach($data['data'] as $task){
            $this->collection->push(
                new TaskData(
                    externalId: (int)$task['id'],
                    projectId: (int)$task['project_id'],
                    title: $task['title'],
                    milestoneId: $task['milestone_id'] ?? null,
                    employeeId: $task['emloyee_id'] ?? null,
                    description: $task['description'],
                    startDate: $task['start_date'],
                    dueDate: $task['due_date'],
                    status: $task['status'],
                    priority: $task['priority']
                )
            );
        }

        return new TaskDataCollection($this->collection);
    }

}