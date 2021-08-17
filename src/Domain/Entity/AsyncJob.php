<?php

declare(strict_types=1);

namespace App\Domain\Entity;

/**
 *  AsyncJob Entity Definition.
 */
final class AsyncJob
{
    private string $id;

    private Task $task;

    private array $response;

    public function __construct($task)
    {
        $this->id = Uuid::generate();
        $this->task = $task;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): array
    {
        return $this->response;
    }
}
