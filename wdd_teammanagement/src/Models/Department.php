<?php

namespace wdd\teammanagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table='departments';
    protected $fillable=[
        'name'
    ];
}
