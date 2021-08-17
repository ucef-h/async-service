<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

final class AsyncProcessException extends Exception
{
    private array $jobs;

    public function __construct(array $jobs)
    {
        $this->jobs = $jobs;
        parent::__construct($this->buildMessage());
    }

    private function buildMessage(): string
    {
        return sprintf('Excption while executin Async Job');
    }
}
