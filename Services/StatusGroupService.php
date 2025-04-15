<?php

namespace Dev\LaravelStatusModule\Services;

use Dev\LaravelStatusModule\Interfaces\StatusGroupAssociationInterface;
use Dev\LaravelStatusModule\Interfaces\StatusGroupRepositoryInterface;
use Dev\LaravelStatusModule\Models\Status;
use Dev\LaravelStatusModule\Models\StatusGroup;
use Dev\LaravelStatusModule\Validators\StatusGroupValidator;
use Dev\LaravelStatusModule\Utils\SlugGenerator;
use Illuminate\Support\Collection;

class StatusGroupService
{


    function __construct(
        private StatusGroupRepositoryInterface $statusGroupRepository,
        private StatusGroupValidator $validator,
        private SlugGenerator $slugGenerator,
        private StatusGroupAssociationInterface $statusGroupAssociation
    ) {
       
    }

    public function getStatusesFromGroups(...$group_slug): Collection
    {
        /**
         *  @var Collection $groups
         */

        $groups = $this->statusGroupRepository->getStautsGroupWithStatus($group_slug);

        return $groups->keyBy('slug')->map(function($group){
            return $group->statuses;
        });
    }

    public function createStatusGroup(array $data): StatusGroup
    {
        $this->validator->validateMandatoryFields($data, ['name']);

        $group = $this->statusGroupRepository->getStatusGroupBySlug($data['slug']);
        if ($group) {
            throw new \Exception("Group with slug {$data['slug']} already exists");
        }

        $data['slug'] = $this->slugGenerator->generateSlug($data['name'], $data['slug'] ?? null);

        return $this->statusGroupRepository->createStatusGroup($data);
    }

    public function addStatusToStatusGroup(StatusGroup | string $statusGroup, Status | string $status): StatusGroup
    {
        $group = is_string($statusGroup) ? $this->statusGroupRepository->getStatusGroupBySlug($statusGroup) : $statusGroup;
        $status = is_string($status) ? $this->statusGroupRepository->getStatusByCode($status) : $status;

        if(!$group){
            throw new \Exception("Group with slug {$statusGroup} not found");
        }

        if(!$status){
            throw new \Exception("Status with code {$status} not found");
        }

        return $this->statusGroupRepository->addStatusToGroup($group, $status, $status->defualt_name);
    }

    public function addMultipleStatusToStatusGroup(StatusGroup | string $statusGroup, Status ...$statuses): StatusGroup
    {
        $group = is_string($statusGroup) ? $this->statusGroupRepository->getStatusGroupBySlug($statusGroup) : $statusGroup;

        if(!$group){
            throw new \Exception("Group with slug {$statusGroup} not found");
        }

        return $this->statusGroupAssociation->addMultipleStatusToStatusGroup($group, ...$statuses);
    }


    public function getAllowedStatusesFromClass(string $class): Collection
    {
        $key = config('status_module.model_groups.' . $class);

        return $this->statusGroupRepository->getStautsGroupWithStatus($key);
    }
}