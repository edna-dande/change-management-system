<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'request_id'];

    // RequestType belongs to User (Many-to-One)
    public function user() {
        return $this->belongsTo(User::class);
    }
}

