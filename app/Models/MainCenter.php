<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCenter extends Model
{
    use HasFactory;
    public function subcenter()
    {
        return $this->belongsTo(SubCenter::class);
    }
}
