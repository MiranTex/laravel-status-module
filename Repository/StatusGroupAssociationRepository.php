<?php 

namespace Dev\LaravelStatusModule\Repository;

use Dev\LaravelStatusModule\Interfaces\StatusGroupAssociationInterface;
use Dev\LaravelStatusModule\Models\Status;
use Dev\LaravelStatusModule\Models\StatusGroup;

class StatusGroupAssociationRepository implements StatusGroupAssociationInterface {

    public function addStatusToGroup(StatusGroup $group, Status $status, string $customName) : StatusGroup {
        $lastPosition = $group->statuses()->max('position');
        $position = $lastPosition ? $lastPosition + 1 : 1;

        $group->statuses()->attach($status, [
            'custom_name' => $customName,
            'position' => $position,
            'status' => true
        ]);

        return $group;
    }

    public function addMultipleStatusToStatusGroup(StatusGroup $group, Status ...$statuses) : StatusGroup {
        $lastPosition = $group->statuses()->max('position');
        $position = $lastPosition ? $lastPosition + 1 : 1;

        $toAttach = [];

        foreach ($statuses as $status) {
            $toAttach[$status->id] = [
                'position' => $position,
                'status' => true
            ];

            $position ++;
        }


        $group->statuses()->attach($toAttach);

        return $group;
        
    }

    public function removeStatusFromGroup(StatusGroup $group, Status $status) : StatusGroup {
        $group->statuses()->detach($status);
        return $group;
    }

    public function disableStatusInStatusGroup(StatusGroup $group, Status $status) : StatusGroup {
        $group->statuses()->updateExistingPivot($status->id, ['status' => 0]);
        return $group;
    }

    public function enableStatusInStatusGroup(StatusGroup $group, Status $status) : StatusGroup {
        $group->statuses()->updateExistingPivot($status->id, ['status' => 1]);
        return $group;
    }
}
