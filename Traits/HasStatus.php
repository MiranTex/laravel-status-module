<?php

namespace Dev\LaravelStatusModule\Traits;

use Dev\LaravelStatusModule\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

trait HasStatus {

    /**
     * @method Model belongsTo()
     */

    public function status() : BelongsTo{
        return $this->belongsTo(Status::class);
    }

    static public function getAllwedStatuses() : Collection{

        $key = self::class;
        $groupSlug = config('status_module.model_groups.' . $key);

        $statusGroup = Status::from('statuses')
            ->join('status_group_items', 'statuses.id', '=', 'status_group_items.status_id')
            ->join('status_groups', 'status_group_items.status_group_id', '=', 'status_groups.id')
            ->where('status_groups.slug',$groupSlug)
            ->where('status_group_items.status', true)
            ->select('statuses.*')
            ->get();
            
        return $statusGroup;

    }


    public static function getAllowedStatusesStatic(): Collection
    {
        $groupSlug = config('status_module.model_groups.' . static::class);

        if (!$groupSlug) {
            return collect();
        }
        
        return Status::whereHas('groups', function($query) use ($groupSlug) {
            $query->where('slug', $groupSlug)
                ->where('status', true);
        })
        // ->when(config('status-module.cache.enabled'), function($query) {
        //     $query->remember(config('status-module.cache.duration'));
        // })
        ->get();
    }
}