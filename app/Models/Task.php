<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable=[
        'title',
        'description',
        'priority_id',
        'type_task_id',
        'status_task_id',
        'user_id',
    ];

    public function priority(){
        return $this->belongsTo(Priority::class);
    }

    public function type_task(){
        return $this->belongsTo(TypeTask::class);
    }

    public function status_task(){
        return $this->belongsTo(StatusTask::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
