<?php

return [
    'base_url' => env('WORK_MANAGEMENT_BASE_URL'),
    'api' => [
        'projects' => '/projects',
        'count' => [
            'projects' => '/projects/count',
            'timelogs' => '/timelogs/count',
            'employees' => '/employees/count',
            'milestones' => '/milestones/count',
            'tasks' => '/tasks/count',
        ],
        'timelogs' => '/timelogs',
        'employees' => '/employees',
        'milestones' => '/milestones',
        'tasks' => '/tasks',
    ],
];
