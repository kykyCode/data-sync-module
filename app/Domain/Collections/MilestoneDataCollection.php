<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\DTOs\MilestoneData;

class MilestoneDataCollection extends DataCollection
{
    public function getItemClassName(): string
    {
        return MilestoneData::class;
    }
}


