<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public function center()
    {
        return $this->hasOne(SubCenter::class,'id');
    }
    public function staff()
    {
        return $this->hasOne(Employee::class,'id');
    }
}
