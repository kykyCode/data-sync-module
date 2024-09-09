<?php

declare(strict_types=1);

namespace App\Domain\DTOs;

class ProjectData
{
    public function __construct(
        public int $externalId,
        public string $name,
        public string $description,
        public string $startDate,
        public string $endDate,
        public string $status,
        public ?int   $projectManagerId = null,
    ) {}
}
