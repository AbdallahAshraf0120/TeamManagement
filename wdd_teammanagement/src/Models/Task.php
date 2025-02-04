<?php

namespace wdd\teammanagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function employee(){
        return $this->belongsTo(Employee::class,'emp_id');
    }
}
