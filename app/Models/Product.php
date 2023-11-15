<?php

namespace App\Models;

use App\Traits\Patterns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Patterns;

    protected $fillable = [
        'name',
        'price'
    ];
}
