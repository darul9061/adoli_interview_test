<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'description'];
    protected $guarded = ['accomplished', 'group_tag', 'project_id'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // public function users()
    // {
    //     return $this->hasManyThrough(User::class, Project::class,null, null, 'project_id');
    // }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
