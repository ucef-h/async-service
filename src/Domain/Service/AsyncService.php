<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\ValueObject\JobCollection;

/**
 * class AsyncService
 * Developer will use this service to run AsyncJobs in Parallel.
 */
final class AsyncService
{
    private AsyncJobInterface $asyncProvider;

    public function __construct($asyncProvider)
    {
        $this->asyncProvider = $asyncProvider;
    }

    public function dispatch(JobCollection $jobCollection): JobCollection
    {
        return $this->asyncProvider->dispatch($jobCollection);
    }
}
