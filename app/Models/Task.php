<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    protected $fillable = ['complete'];
    protected $guarded = ['group_id', 'project_id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
