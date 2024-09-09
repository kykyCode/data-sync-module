<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\DTOs\ProjectData;

class ProjectDataCollection extends DataCollection
{
    public function getItemClassName(): string
    {
        return ProjectData::class;
    }
}


