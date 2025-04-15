<?php

namespace Dev\LaravelStatusModule\Interfaces;

use Dev\LaravelStatusModule\Models\Status;
use Dev\LaravelStatusModule\Models\StatusGroup;

interface StatusGroupAssociationInterface
{
    public function addStatusToGroup(StatusGroup $group, Status $status, string $customName): StatusGroup;

    public function addMultipleStatusToStatusGroup(StatusGroup $group, Status ...$statuses) : StatusGroup;

    public function removeStatusFromGroup(StatusGroup $group, Status $status): StatusGroup;

    public function disableStatusInStatusGroup(StatusGroup $group, Status $status): StatusGroup;

    public function enableStatusInStatusGroup(StatusGroup $group, Status $status): StatusGroup;
}
