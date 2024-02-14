<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexMember extends Model
{
    use HasFactory;
    public function index()
    {
        return $this->hasMany(IndexMember::class);
    }
}
