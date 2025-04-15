<?php

namespace Dev\LaravelStatusModule\Interfaces;

use Dev\LaravelStatusModule\Models\Status;

interface StatusRepositoryInterface
{
    public function createStatus(array ...$data): bool;

    public function getStatusByCode(string $code): Status | null;

}