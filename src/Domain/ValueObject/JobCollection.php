<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Service\AsyncJob;

/**
 * Collection of Jobs that need to be executed in parallel.
 */
final class JobCollection
{
    private array $jobs;

    public function __construct(array $jobs)
    {
        $this->jobs = $jobs;
    }

    public function getJobs(): array
    {
        return $this->jobs;
    }

    public function getJobById(string $id): ?AsyncJob
    {
        $filterd = array_filter($this->jobs, function (AsyncJob $job) use (&$id) {
            return $job->getId() == $id;
        });

        if (! empty($filterd)) {
            return $filterd[0];
        }

        return null;
    }
}
