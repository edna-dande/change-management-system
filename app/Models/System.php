<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    // System has many Requests (One-to-Many)
    public function requests() {
        return $this->hasMany(Request::class);
    }
}
