<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Mappers;

use App\Domain\Collections\EmployeeDataCollection;
use App\Domain\DTOs\EmployeeData;
use App\Domain\Mappers\DataCollectionMapper;

class WorkManagmentResponseToEmployeeDataMapper extends DataCollectionMapper{
    public function map(iterable $data): EmployeeDataCollection
    {
        foreach($data['data'] as $employee){
            $this->collection->push(
                new EmployeeData(
                    externalId: (int)$employee['id'],
                    name: $employee['name'],
                    email: $employee['email'],
                    role: $employee['role'],
                    phone: $employee['phone'],
                    emergencyContact: $employee['phone']
                )
            );
        }

        return new EmployeeDataCollection($this->collection);
    }

}