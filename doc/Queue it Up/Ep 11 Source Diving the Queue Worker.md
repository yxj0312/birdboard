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