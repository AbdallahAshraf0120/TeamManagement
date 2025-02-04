<?php

namespace wdd\teammanagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
