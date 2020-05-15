<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mock extends Model
{
    use SoftDeletes;

    protected $fillable = ['endpoint', 'query', 'payload'];
}
