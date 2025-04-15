<?php 

namespace Dev\LaravelStatusModule\Repository;

use Dev\LaravelStatusModule\Interfaces\StatusGroupRepositoryInterface;
use Dev\LaravelStatusModule\Models\StatusGroup;
use Illuminate\Support\Collection;

class StatusGroupRepository implements StatusGroupRepositoryInterface {

    public function getStatusGroupBySlug(string $slug) : StatusGroup | null {
        return StatusGroup::where('slug', $slug)->first();
    }

    public function createStatusGroup(array $data) : StatusGroup {
        return StatusGroup::create($data);
    }

    public function getStautsGroupWithStatus(...$group_slug) : Collection {
        return StatusGroup::where('slug', $group_slug)
            ->with([
                'statuses' => fn($query) => $query->where('statuses.status', 1)
                    ->orderBy('position')
            ])
            ->get();
    }
}
