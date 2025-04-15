<?php

return [

    'model_groups' => [
        'app\Models\Model' => 'StatusGroupName',
        User::class => 'user-statuses',
        
    ],

    'cache' => [
        'enabled' => false,
        'duration' => 60
    ]

];