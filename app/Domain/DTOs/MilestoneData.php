<?php

declare(strict_types=1);

namespace App\Domain\DTOs;

class MilestoneData
{
    public function __construct(
        public int    $externalId,
        public int    $projectId,
        public string $title,
        public ?string $description = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?string $status = null,
    ) {}
}
