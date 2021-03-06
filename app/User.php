<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        // return $this->hasMany(Project::class, 'owner_id')->orderBy('updated_at', 'desc');
        // return $this->hasMany(Project::class, 'owner_id')->orderByDesc('updated_at');
        return $this->hasMany(Project::class, 'owner_id')->latest('updated_at');
    }

    public function accessibleProjects()
    {
        // Only give me the project, where has memeber, that has user_id equasls to this person
        return Project::where('owner_id', $this->id)
            ->orWhereHas('members', function ($query) {
                // When I remove this code, the test is still passing!
                // -> change test, add a user called nick, who doesen't belongs to the project
                $query->where('user_id', $this->id);
            })
            ->get();
    }
}
