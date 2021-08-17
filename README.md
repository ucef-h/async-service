# async-service

## Intro

```App\Domain\Service\AsyncService``` is the entry point to execute parallel tasks. 

```App\Domain\Entity\AsyncJob``` Entity that define a Job, composed from **id**, **task** and **response**.

```App\Domain\ValueObject\Task``` The operation that need to be executed Asynchronously. in our context it is the SQL Query.

```App\Domain\Service\AsyncJobInterface``` Interface that need to be implemented by the Infastructure layer to dispatch jobs in parallel.

```App\Infrastructure\Services\GearmanAsyncJob``` Implement **AsyncJobInterface** uses **Gearman** as Job Dispatcher


Developer will be able to dispach Tasks without worrying about the Infrastucture and how the Jobs are being executed.

The developer need to work with the Infrastucture to write the Task Definition and Resolver.

## How to
```php

$service = new AsyncService();

 $collection = $service->dispatch(new JobCollection([
                new AsyncJob(new Task('resolver', [])),
                new AsyncJob(new Task('resolver', [])),
                ])
        );

```

