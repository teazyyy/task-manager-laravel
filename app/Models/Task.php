<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'task_status_id', 'is_completed'];

public function user()
{
    return $this->belongsTo(User::class);
}

public function status()
{
    return $this->belongsTo(TaskStatus::class, 'task_status_id');
}



}

