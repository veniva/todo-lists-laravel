<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    /**
     * The attributes that are mass assignable.
     * This will allow us to fill the "title" attribute when using Eloquent's create method
     * @var array
     */
    protected $fillable = ['title'];

    protected $table = 'todo_lists';

    /**
     * Get the user that owns the List.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
