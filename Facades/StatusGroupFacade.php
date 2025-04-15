<?php

namespace Dev\LaravelStatusModule\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection getStatusesFromGroups(...$group_slug)
 * @method static \Illuminate\Support\Collection getStatusesFromGroup(string $group_slug)
 * @method static \Dev\LaravelStatusModule\Models\StatusGroup createStatusGroup(array $data)
 * @method static \Dev\LaravelStatusModule\Models\StatusGroup addMultipleStatusToStatusGroup(\Dev\LaravelStatusModule\Models\StatusGroup $statusGroup, \Dev\LaravelStatusModule\Models\Status $statuses)
 * @method static \Illuminate\Support\Collection getAllowedStatusesFromClass(string $class): Collection
 * @see \Dev\LaravelStatusModule\Services\StatusGroupService
 */
class StatusGroupFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'statusGroupService';
    }
}
