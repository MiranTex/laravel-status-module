<?php 

namespace Dev\LaravelStatusModule\Repository;

use Dev\LaravelStatusModule\Interfaces\StatusRepositoryInterface;
use Dev\LaravelStatusModule\Models\Status;
use Illuminate\Support\Collection;

class StatusRepository implements StatusRepositoryInterface {

    public function createStatus(array ...$data) : bool {
        return Status::insert($data);
    }

    public function getStatusByCode(string $code) : Status | null {
        return Status::where('code', $code)->first();
    }

}