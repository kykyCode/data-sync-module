<?php

namespace App\Jobs\WorkManagment;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Modules\WorkManagment\Repositories\MilestoneRepository;
use App\Modules\WorkManagment\Services\WorkManagmentService;
use App\Modules\WorkManagment\Mappers\WorkManagmentResponseToMilestoneDataMapper;

class SyncMilestones implements ShouldQueue
{
    use Dispatchable, Queueable, Batchable, InteractsWithQueue;

    public $tries = 3;

    public function __construct(
        protected int $page,
        public ?int    $timeout = 900,
    ) {}

    public function handle(
        MilestoneRepository                                  $repository,
        WorkManagmentResponseToMilestoneDataMapper           $mapper,
        WorkManagmentService                                 $service,
    ): void {
        $milestones = $service->getMilestones($this->page);
        $repository->createOrUpdateMilestones(
            $mapper->map($milestones)
        );
    }

    public function backoff(): array
    {
        return [5, 10, 15];
    }
}
