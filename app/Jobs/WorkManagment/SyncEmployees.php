<?php

namespace App\Jobs\WorkManagment;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Modules\WorkManagment\Repositories\EmployeeRepository;
use App\Modules\WorkManagment\Services\WorkManagmentService;
use App\Modules\WorkManagment\Mappers\WorkManagmentResponseToEmployeeDataMapper;

class SyncEmployees implements ShouldQueue
{
    use Dispatchable, Queueable, Batchable, InteractsWithQueue;

    public $tries = 3;
    public function __construct(
        protected int $page,
        public ?int    $timeout = 900,
    ) {}

    public function handle(
        EmployeeRepository                                  $repository,
        WorkManagmentResponseToEmployeeDataMapper           $mapper,
        WorkManagmentService                                $service,
    ): void {
        $categories = $service->getEmployees($this->page);
        $repository->createOrUpdateEmployees(
            $mapper->map($categories)
        );
    }

    public function backoff() : array{
        return  [5,10,15];
    }
}
