<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // System has many Requests (One-to-Many)
    public function changeRequest() {
        return $this->hasOne(ChangeRequest::class);
    }
}
