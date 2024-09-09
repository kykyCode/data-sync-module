<?php

declare(strict_types=1);

namespace App\Domain\DTOs;

class TaskData
{
    public function __construct(
        public int     $externalId,
        public int     $projectId,
        public ?int    $milestoneId = null,
        public ?int    $employeeId = null,
        public string  $title,
        public ?string $description = null,
        public ?string $status = null,
        public ?string $priority = null,
        public ?string $startDate = null,
        public ?string $dueDate = null,
    ) {}
}
