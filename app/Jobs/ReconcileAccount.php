<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReconcileAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Filesystem $file)
    {
        // queue:work --tries=3 /queue:retry/queue:failed-table
        // throw new \Exception('Whoops!');
        // Play wow classic, finishe watching this ep video, although can't be used by windows 10

        // $file->put(public_path('testing.txt'), 'Reconciling: '.$this->user->name);
        logger('Reconciling the user: '.$this->user->name);
    }
}
