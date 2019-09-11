### Pipeline is like laravel middleware:

We send the data through a series of pipes, each of those pipeline just the middleware, have the opportunity to modify that data or to even throw an exception and hold the process entirely, they can do what they want, until they pass the request onto the 'next layer of the onion' or the next pipe

in vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php
```php
/**
     * Send the given request through the middleware / router.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendRequestThroughRouter($request)
    {
        $this->app->instance('request', $request);

        Facade::clearResolvedInstance('request');

        $this->bootstrap();

        return (new Pipeline($this->app))
                    ->send($request)
                    ->through($this->app->shouldSkipMiddleware() ? [] : $this->middleware)
                    ->then($this->dispatchToRouter());
    }
```