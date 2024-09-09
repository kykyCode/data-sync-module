<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\DTOs\TaskData;

class TaskDataCollection extends DataCollection
{
    public function getItemClassName(): string
    {
        return TaskData::class;
    }
}


