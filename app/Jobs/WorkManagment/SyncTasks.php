<?php

namespace App\Jobs\WorkManagment;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Modules\WorkManagment\Repositories\TaskRepository;
use App\Modules\WorkManagment\Services\WorkManagmentService;
use App\Modules\WorkManagment\Mappers\WorkManagmentResponseToTaskDataMapper;

class SyncTasks implements ShouldQueue
{
    use Dispatchable, Queueable, Batchable, InteractsWithQueue;

    public $tries = 3;
    public function __construct(
        protected int  $page,
        public ?int    $timeout = 900,
    ) {}

    public function handle(
        TaskRepository                                  $repository,
        WorkManagmentResponseToTaskDataMapper           $mapper,
        WorkManagmentService                               $service,
    ): void {
        $tasks = $service->getTasks($this->page);
        $repository->createOrUpdateTasks(
            $mapper->map($tasks)
        );
    }

    public function backoff() : array{
        return  [5,10,15];
    }
}
