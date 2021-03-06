<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $appends = ['edited'];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function getEditedAttribute()
    {
        return $this->created_at != $this->updated_at;
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function members()
    {
        // is it true that a project can have many members
        // and also a member can have many projects
        // both true, so I wanna a pivot table
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }

    public function addTasks($tasks)
    {
        return $this->tasks()->createMany($tasks);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }
}
