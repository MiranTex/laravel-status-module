<?php

namespace Dev\LaravelStatusModule\Models;

use Illuminate\Database\Eloquent\Model;

class StatusGroup extends Model
{
    protected $table = 'status_groups';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id','name', 'slug'];



    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'status_group_items', 'status_group_id', 'status_id')
            ->using(StatusGroupItem::class)
            ->wherePivot('status', true)
            ->withPivot('custom_name', 'status', 'position')
            ->withTimestamps();
    }
}