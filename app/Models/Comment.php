<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['message'];
    protected $guarded = ['group_id', 'project_id', 'task_id', 'user_id'];

    public function task()
    {
        return $this->belongsTo(Group::class);
    }
}
