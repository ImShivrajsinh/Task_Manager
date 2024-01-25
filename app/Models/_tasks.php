<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'taskname',
        'taskdescription',
        'duedate',
    ];
}
