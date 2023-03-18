<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recreation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'price',
        'size',
        'capacity',
        'services',
        'description'
    ];

}
