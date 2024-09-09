<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Mappers;

use App\Domain\DTOs\TimeLogData;
use App\Domain\Mappers\DataCollectionMapper;
use App\Domain\Collections\TimeLogDataCollection;

class WorkManagmentResponseToTimeLogDataMapper extends DataCollectionMapper
{
    public function map(iterable $data): TimeLogDataCollection
    {
        foreach ($data['data'] as $timeLog) {
            $this->collection->push(
                new TimeLogData(
                    externalId: (int)$timeLog['external_id'],
                    taskId: (int)$timeLog['task_id'],
                    employeeId: (int)$timeLog['employee_id'],
                    hoursSpent: (float)$timeLog['hours_spent']
                )
            );
        }

        return new TimeLogDataCollection($this->collection);
    }
}
