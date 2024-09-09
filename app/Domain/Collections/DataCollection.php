<?php

namespace App\Domain\Collections;

use Illuminate\Support\Collection;

abstract class DataCollection
{
    const MESSAGE = 'Invalid collection items provided for `%s`, only items of class `%s` allowed.';

    public function __construct(
        protected Collection $collection
    ) {
        $this->validate($collection);
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    abstract public function getItemClassName(): string;

    protected function validate(Collection $collection): void
    {
        $className = $this->getItemClassName();
        foreach ($collection as $item) {
            if (!$item instanceof $className) {
                throw new \InvalidArgumentException(
                    sprintf(self::MESSAGE, self::class, $className)
                );
            }
        }
    }
}
