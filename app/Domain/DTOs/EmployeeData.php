<?php

declare(strict_types=1);

namespace App\Domain\DTOs;

class EmployeeData
{
    public function __construct(
        public int     $externalId,
        public string  $name,
        public string  $email,
        public ?string $role = null,
        public ?int    $departmentId = null,
        public ?string $phone = null,
        public ?string $emergencyContact = null,
    ) {}
}
