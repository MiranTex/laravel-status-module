<?php

namespace Dev\LaravelStatusModule\Interfaces;

use Dev\LaravelStatusModule\Models\StatusGroup;
use Illuminate\Support\Collection;

interface StatusGroupRepositoryInterface
{
    public function getStatusGroupBySlug(string $slug): StatusGroup | null;

    public function createStatusGroup(array $data): StatusGroup;

    public function getStautsGroupWithStatus(...$group_slug): Collection;
}
