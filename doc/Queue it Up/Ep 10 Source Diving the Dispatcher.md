Dispathable.php -> PendingDispatch.php... ->@__destruct

```php
/**
 * Handle the object's destruction.
 *
 * @return void
 */
public function __destruct()
{
    app(Dispatcher::class)->dispatch($this->job);
}
```
-> Dispatcher::class
-> Check if it should be queued
-> If now, go dispatchNow

<!-- 2019年9月13日，过中秋节 -->

```php
/**
 * Dispatch a command to its appropriate handler in the current process.
 *
 * @param  mixed  $command
 * @param  mixed  $handler
 * @return mixed
 */
public function dispatchNow($command, $handler = null)
{
    if ($handler || $handler = $this->getCommandHandler($command)) {
        $callback = function ($command) use ($handler) {
            return $handler->handle($command);
        };
    } else {
        $callback = function ($command) {
            return $this->container->call([$command, 'handle']); //resolves the instance ReconilAccount
        };
    }

    // What pipes do we have?
    return $this->pipeline->send($command)->through($this->pipes)->then($callback);
}
```

-> What pipes do we have?



