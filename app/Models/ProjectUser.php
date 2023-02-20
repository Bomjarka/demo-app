<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends User
{
    use HasFactory;

    protected $fillable = [
       'login'
    ];
}
