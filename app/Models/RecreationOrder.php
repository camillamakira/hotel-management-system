<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recreation;
use App\Models\User; 

class RecreationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'recreation_id',
        'user_id',
        'id',
    ];

    public function recreation()
    {
        return $this->belongsTo(Recreation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
