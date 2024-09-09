<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Mappers;

use App\Domain\Collections\MilestoneDataCollection;
use App\Domain\DTOs\MilestoneData;
use App\Domain\Mappers\DataCollectionMapper;

class WorkManagmentResponseToMilestoneDataMapper extends DataCollectionMapper
{
    public function map(iterable $data): MilestoneDataCollection
    {
        foreach ($data['data'] as $milestone) {
            $this->collection->push(
                new MilestoneData(
                    externalId: (int)$milestone['id'],
                    projectId: (int)$milestone['project_id'],
                    title: $milestone['title'],
                    description: $milestone['description'],
                    startDate: $milestone['start_date'],
                    endDate: $milestone['end_date'],
                    status: $milestone['status']
                )
            );
        }

        return new MilestoneDataCollection($this->collection);
    }
}
