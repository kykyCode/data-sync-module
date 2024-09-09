<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Mappers;

use App\Domain\DTOs\ProjectData;
use App\Domain\Mappers\DataCollectionMapper;
use App\Domain\Collections\ProjectDataCollection;

class WorkManagmentResponseToProjectDataMapper extends DataCollectionMapper{
    public function map(iterable $data): ProjectDataCollection
    {
        foreach($data['data'] as $project){
            $this->collection->push(
                new ProjectData(
                    externalId: (int)$project['id'],
                    name: $project['name'],
                    description: $project['description'],
                    startDate: $project['start_date'],
                    endDate: $project['end_date'],
                    status: $project['status'],
                    projectManagerId: $project['manager_id'],
                )
            );
        }

        return new ProjectDataCollection($this->collection);
    }

}