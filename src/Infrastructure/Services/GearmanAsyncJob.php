<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Exception\AsyncProcessException;
use App\Domain\Service\AsyncJob;
use App\Domain\Service\AsyncJobInterface;
use App\Domain\ValueObject\JobCollection;

/**
 * Class GearmanAsyncJob.
 *
 * responsible to abstract the Async Job
 *
 * Implements AsyncJobInterface
 *
 * Gearman could be replaced with other providers
 */
final class GearmanAsyncJob implements AsyncJobInterface
{
    private GearmanClient $client;

    private array $response;

    public function __construct(GearmanClient $client)
    {
        $this->client = $client;
        $this->response = [];
    }

    public function dispatch(JobCollection $jobCollection): JobCollection
    {
        /** @var AsyncJob $job */
        foreach ($jobCollection->getJobs() as $job) {
            $this->client->addTask($job->getTask()->getResolver(), $job->getTask()->getPayload(), null, $job->getTask()->getId());
        }

        $this->client->setCompleteCallback('completeTasks');

        if (! $this->client->runTasks()) {
            throw new AsyncProcessException($jobCollection->getJobs());
        }

        /*
         * Wait till all the jobs are done
         *
         * Loop on the response array and fill the data in the job Collection
         *
         */

        return $jobCollection;
    }

    private function completeTasks(GearmanTask $task): void
    {
        $this->response[$task->unique()] = $task->data();
    }
}
