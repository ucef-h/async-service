<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\ValueObject\JobCollection;

/**
 * Interface that need to be implemented by the Infastructure layer to dispatch jobs in parallel.
 */
interface AsyncJobInterface
{
    public function dispatch(JobCollection $jobCollection): JobCollection;
}
