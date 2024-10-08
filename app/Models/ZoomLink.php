<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'link', 'description'];
}
