<?php

namespace Dev\LaravelStatusModule\Tests\Unit;

use Dev\LaravelStatusModule\Interfaces\StatusRepositoryInterface;
use Dev\LaravelStatusModule\Models\StatusGroup;
use Dev\LaravelStatusModule\Services\StatusGroupService;
use PHPUnit\Framework\TestCase;

class StatusGroupServiceTest extends TestCase{

    function testStatusGroupCreation(){

        /**
         * @var StatusRepositoryInterface $statusRepository
         */
        $statusRepository = $this->createMock(StatusRepositoryInterface::class);

        $statusRepository->method('createStatusGroup')
            ->willReturn(new StatusGroup([
                'name' => 'group1',
                'slug' => 'group_1'
            ]));

        $statusRepository->method('getStatusGroupBySlug')
            ->willReturn(null);

        $statusGroupService = new StatusGroupService($statusRepository);

        $statusGroup = $statusGroupService->createStatusGroup([
            'name' => 'group1',
            'slug' => 'group_1'
        ]);

        
        $this->assertEquals('group1', $statusGroup->name);
        $this->assertEquals('group_1', $statusGroup->slug);

    }


    function testIfThereISSameSlugItWillFail(){

        /**
         * @var StatusRepositoryInterface $statusRepository
         */
        $statusRepository = $this->createMock(StatusRepositoryInterface::class);

        $statusRepository->method('getStatusGroupBySlug')
            ->willReturn(new StatusGroup([
                'name' => 'group1',
                'slug' => 'group_1'
            ]));

        $statusGroupService = new StatusGroupService($statusRepository);
        
        $this->expectException(\Exception::class);

        $statusGroup = $statusGroupService->createStatusGroup([
            'name' => 'group1',
            'slug' => 'group_1'
        ]);

    }
}