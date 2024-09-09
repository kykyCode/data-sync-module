<?php

namespace App\Modules\WorkManagment\Services;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use App\Jobs\WorkManagment\SyncTasks;
use App\Jobs\WorkManagment\SyncProjects;
use App\Jobs\WorkManagment\SyncTimeLogs;
use App\Jobs\WorkManagment\SyncEmployees;
use App\Jobs\WorkManagment\SyncMilestones;
use App\Modules\WorkManagment\Facades\WorkManagmentFacade;

class SyncService {

    public function syncEmployees(){

        Bus::batch(array_map(function ($page){
            return new SyncEmployees($page);
        }, range(0, WorkManagmentFacade::getEmployeesPageCount())))
            ->name(sprintf('Sync employees (%s)', now()->format('Y-m-d H:i')))
            ->finally(function(){
                $this->syncProjects();
            })
        ->dispatch();
    }

    public function syncProjects(){
        Bus::batch(array_map(function ($page){
            return new SyncProjects($page);
        }, range(0, WorkManagmentFacade::getProjectsPageCount())))
            ->name(sprintf('Sync projects (%s)', now()->format('Y-m-d H:i')))
            ->finally(function(){
                $this->syncMilestones();
            })
        ->dispatch();
    }

    public function syncMilestones(){
        Bus::batch(array_map(function ($page){
            return new SyncMilestones($page);
        }, range(0, WorkManagmentFacade::getTimeLogsPageCount())))
            ->name(sprintf('Sync milestones (%s)', now()->format('Y-m-d H:i')))
            ->finally(function(){
                $this->syncTasks();
            })
        ->dispatch();
    }

    public function syncTasks(){
        Bus::batch(array_map(function ($page){
            return new SyncTasks($page);
        }, range(0, WorkManagmentFacade::getTasksPageCount())))
            ->name(sprintf('Sync tasks (%s)', now()->format('Y-m-d H:i')))
            ->finally(function(){
                $this->syncTimeLogs();
            })
        ->dispatch();
    }

    public function syncTimeLogs(){
        Bus::batch(array_map(function ($page){
            return new SyncTimeLogs($page);
        }, range(0, WorkManagmentFacade::getTimeLogsPageCount())))
            ->name(sprintf('Sync tasks (%s)', now()->format('Y-m-d H:i')))
            ->finally(function(){
                Log::channel('work-managment-sync')->info('All synchronization processes have been completed.');
            })
        ->dispatch();
    }

   
}