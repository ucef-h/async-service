<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

/**
 * Task Value Object represent the operation that need to executed by the Async Worker.
 */
final class Task
{
    private string $resolver;

    private array $payload;

    public function __construct(string $resolver, array $payload)
    {
        $this->resolver = $resolver;
        $this->payload = $payload;
    }

    public function getResolver(): string
    {
        return $this->resolver;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
