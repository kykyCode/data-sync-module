<?php

namespace App\Console\Commands\WorkManagment;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Modules\WorkManagment\Services\SyncService as WorkManagmentSyncService;

class SyncWorkManagmentDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:work-managment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs work management data, specifically employees, from the external work management system into the local database. 
                              This command uses the WorkManagmentSyncService to fetch and update employee data, ensuring that local records 
                              are up-to-date with the latest information. It logs errors to the work-managment-sync channel if any exceptions occur 
                              during the synchronization process.';

    /**
     * Execute the console command.
     */
    public function handle(WorkManagmentSyncService $syncService): int
    {
        try {
            $syncService->syncEmployees();
        } catch (\Exception $e) {
            Log::channel('work-managment-sync')
                ->error($e->getLine() . ' ' . $e->getFile() . ' ' . $e->getMessage());
        }
        return Command::SUCCESS;
    }
}
