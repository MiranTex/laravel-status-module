<?php

namespace Dev\LaravelStatusModule\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StatusGroupItem extends Pivot
{
    protected $table = 'status_group_items';
    protected $keyType = 'string';
    public $incrementing = false;


    public function statusGroup()
    {
        return $this->belongsTo(StatusGroup::class, 'status_group_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

}