<?php

declare(strict_types=1);

namespace App\Domain\DTOs;

class TimeLogData
{
    public function __construct(
        public int    $externalId,
        public int    $taskId,
        public int    $employeeId,
        public float  $hoursSpent,
    ) {}
}
