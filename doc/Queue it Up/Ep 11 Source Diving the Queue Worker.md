dispatchToQueue Method
```php
/**
 * Dispatch a command to its appropriate handler behind a queue.
 *
 * @param  mixed  $command
 * @return mixed
 *
 * @throws \RuntimeException
 */
public function dispatchToQueue($command)
{
    // Is there special connection(database, sqs, redis) we are using
    $connection = $command->connection ?? null;

    // Which queue do you want to use?
    $queue = call_user_func($this->queueResolver, $connection);

    if (! $queue instanceof Queue) {
        throw new RuntimeException('Queue resolver did not return a Queue implementation.');
    }

    if (method_exists($command, 'queue')) {
        return $command->queue($queue, $command);
    }

    return $this->pushCommandToQueue($queue, $command);
}
```

You call a queue method by 'pushCommandToQueue'

```php
/**
 * Push the command onto the given queue instance.
 *
 * @param  \Illuminate\Contracts\Queue\Queue  $queue
 * @param  mixed  $command
 * @return mixed
 */
protected function pushCommandToQueue($queue, $command)
{
    if (isset($command->queue, $command->delay)) {
        return $queue->laterOn($command->queue, $command->delay, $command);
    }

    if (isset($command->queue)) {
        return $queue->pushOn($command->queue, $command);
    }

    if (isset($command->delay)) {
        return $queue->later($command->delay, $command);
    }

    return $queue->push($command);
}
```

What happens after run php artisan queue:work?

vendor\laravel\framework\src\Illuminate\Queue\Console\WorkCommand.php
->getQueue()
->runWorker()

How we run the worker?

```php
    /**
     * Run the worker instance.
     *
     * @param  string  $connection: data base connection 
     * @param  string  $queue: the default queue
     * @return array
     */
    protected function runWorker($connection, $queue)
    {
        $this->worker->setCache($this->laravel['cache']->driver());

        // delicate to a worker colleberator, and in this case, we use a daemon
        return $this->worker->{$this->option('once') ? 'runNextJob' : 'daemon'}(
            // passing database connection/queue/and any options
            $connection, $queue, $this->gatherWorkerOptions()
        );
    }
```

What is this work colleberator?


