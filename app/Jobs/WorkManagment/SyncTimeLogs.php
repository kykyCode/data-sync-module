<?php

namespace App\Jobs\WorkManagment;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Modules\WorkManagment\Services\WorkManagmentService;
use App\Modules\WorkManagment\Repositories\TimeLogRepository;
use App\Modules\WorkManagment\Mappers\WorkManagmentResponseToTimeLogDataMapper;

class SyncTimeLogs implements ShouldQueue
{
    use Dispatchable, Queueable, Batchable, InteractsWithQueue;

    public $tries = 3;
    public function __construct(
        protected int $page,
        public ?int    $timeout = 900,
    ) {}

    public function handle(
        TimeLogRepository                                  $repository,
        WorkManagmentResponseToTimeLogDataMapper           $mapper,
        WorkManagmentService                               $service,
    ): void {
        $timeLogs = $service->getTimeLogs($this->page);
        $repository->createOrUpdateTimeLogs(
            $mapper->map($timeLogs)
        );
    }

    public function backoff() : array{
        return  [5,10,15];
    }
}
