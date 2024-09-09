<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Facades;

use Illuminate\Support\Facades\Facade;


class WorkManagmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'workManagmentService';
    }
}




