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

