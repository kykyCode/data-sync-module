<?php

declare(strict_types=1);

namespace App\Domain\Mappers;

use App\Domain\Collections\DataCollection;
use Illuminate\Support\Collection;

abstract class DataCollectionMapper
{
    public function __construct(
        protected Collection $collection
    ) {}

    abstract public function map(iterable $data): DataCollection;
}





