<?php

namespace Dev\LaravelStatusModule\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        "id",
        "defualt_name",
        "code",
        "description",
    ];


    public function groups()
    {
        return $this->belongsToMany(StatusGroup::class, 'status_group_items', 'status_id', 'status_group_id')
            ->withPivot('custom_name', 'status')
            ->withTimestamps();
    }
}