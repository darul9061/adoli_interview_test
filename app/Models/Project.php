<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory; use SoftDeletes;


    protected $fillable = ['name'];
    protected $guarded = ['project_tag'];
    protected $attributes = [
        'user_role_id' => 4329
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
