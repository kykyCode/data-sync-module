<?php

declare(strict_types=1);

namespace App\Modules\WorkManagment\Services;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class WorkManagmentService
{
    protected Filesystem $storage;

    public function __construct(
        protected GuzzleClient $client,
    ) {
        $this->storage = Storage::disk('local');
    }

    public function getProjects(int $page): array
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.projects'), [
                    'query' => [
                        'page' => max($page, 1),
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like projects or check your configuration.');
                return ['error' => 'Projects endpoint not found (404).'];
            }
            Log::channel('work-managment-sync')->error('Unable to fetch projects.');
            return ['error' => 'Unable to fetch projects.'];
        }
    }

    public function getProjectsPageCount(): int
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.count.projects'),
            );
            return (int)json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like project page count or check your configuration.');
                return 0;
            }
            Log::channel('work-managment-sync')->error('Unable to fetch project page count.');
            return 0;
        }
    }

    public function getTimeLogs(int $page): array
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.timelogs'), [
                    'query' => [
                        'page' => max($page, 0),
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like timelogs or check your configuration.');
                return ['error' => 'Timelogs endpoint not found (404).'];
            }
            Log::channel('work-managment-sync')->error('Unable to fetch timelogs.');
            return ['error' => 'Unable to fetch timelogs.'];
        }
    }

    public function getTimeLogsPageCount(): int
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.count.timelogs'),
            );
            return (int)json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like timelogs page count or check your configuration.');
                return 0;
            }
            Log::channel('work-managment-sync')->error('Unable to fetch timelogs page count.');
            return 0;
        }
    }

    public function getEmployees(int $page): array
    {
        Log::channel('work-managment-sync')->error('Employees URL: ' . config('work_managment.base_url') . config('work_managment.api.employees'));

        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.employees'), [
                    'query' => [
                        'page' => max($page, 1),
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like employees or check your configuration.');
                return ['error' => 'Employees endpoint not found (404).'];
            }
            Log::channel('work-managment-sync')->error('Unable to fetch employees.');
            return ['error' => 'Unable to fetch employees.'];
        }
    }

    public function getEmployeesPageCount(): int
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.count.employees'),
            );
            return (int)json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like employees page count or check your configuration.');
                return 0;
            }
            Log::channel('work-managment-sync')->error('Unable to fetch employees page count.');
            return 0;
        }
    }

    public function getMilestones(int $page): array
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.milestones'), [
                    'query' => [
                        'page' => max($page, 1),
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like milestones or check your configuration.');
                return ['error' => 'Milestones endpoint not found (404).'];
            }
            Log::channel('work-managment-sync')->error('Unable to fetch milestones.');
            return ['error' => 'Unable to fetch milestones.'];
        }
    }

    public function getMilestonesPageCount(): int
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.count.milestones'),
            );
            return (int)json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like milestones page count or check your configuration.');
                return 0;
            }
            Log::channel('work-managment-sync')->error('Unable to fetch milestones page count.');
            return 0;
        }
    }

    public function getTasks(int $page): array
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.tasks'), [
                    'query' => [
                        'page' => max($page, 1),
                    ]
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like tasks or check your configuration.');
                return ['error' => 'Tasks endpoint not found (404).'];
            }
            Log::channel('work-managment-sync')->error('Unable to fetch tasks.');
            return ['error' => 'Unable to fetch tasks.'];
        }
    }

    public function getTasksPageCount(): int
    {
        try {
            $response = $this->client->get(
                config('work_managment.base_url')
                . config('work_managment.api.count.tasks'),
            );
            return (int)json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 404) {
                Log::channel('work-managment-sync')->error('There is no endpoint like tasks page count or check your configuration.');
                return 0;
            }
            Log::channel('work-managment-sync')->error('Unable to fetch tasks page count.');
            return 0;
        }
    }
}
