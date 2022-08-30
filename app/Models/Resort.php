<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    protected $fillable = ['name','rent_per_day','description','gallery'];
    use HasFactory;
}
