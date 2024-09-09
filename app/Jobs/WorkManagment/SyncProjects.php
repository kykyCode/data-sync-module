<?php

namespace App\Jobs\WorkManagment;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Modules\WorkManagment\Repositories\ProjectRepository;
use App\Modules\WorkManagment\Services\WorkManagmentService;
use App\Modules\WorkManagment\Mappers\WorkManagmentResponseToProjectDataMapper;

class SyncProjects implements ShouldQueue
{
    use Dispatchable, Queueable, Batchable, InteractsWithQueue;

    public $tries = 3;
    public function __construct(
        protected int $page,
        public ?int    $timeout = 900,
    ) {}

    public function handle(
        ProjectRepository                                  $repository,
        WorkManagmentResponseToProjectDataMapper           $mapper,
        WorkManagmentService                               $service,
    ): void {
        $projects = $service->getProjects($this->page);
        $repository->createOrUpdateProjects(
            $mapper->map($projects)
        );
    }

    public function backoff() : array{
        return  [5,10,15];
    }
}
