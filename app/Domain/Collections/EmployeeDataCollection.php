<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\DTOs\EmployeeData;

class EmployeeDataCollection extends DataCollection
{
    public function getItemClassName(): string
    {
        return EmployeeData::class;
    }
}


