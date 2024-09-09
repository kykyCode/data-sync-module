<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\DTOs\TimeLogData;

class TimeLogDataCollection extends DataCollection
{
    public function getItemClassName(): string
    {
        return TimeLogData::class;
    }
}


