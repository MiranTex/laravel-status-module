<?php

namespace Dev\LaravelStatusModule\Utils\Classes;

use ArrayIterator;
use Dev\LaravelStatusModule\Models\Status;
use IteratorAggregate;
use Traversable;

class StatusList implements IteratorAggregate
{

    private array $statuses;

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->statuses);
    }

    public function push(Status $status){
        $this->statuses[] = $status;
    }
}