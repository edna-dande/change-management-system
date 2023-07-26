<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Request belongs to System (Many-to-One)
    public function system() {
        return $this->belongsTo(System::class);
    }

    // Request belongs to Status (Many-to-One)
    public function status() {
        return $this->belongsTo(Status::class);
    }

    // Request belongs to Priority (Many-to-One)
    public function priority() {
        return $this->belongsTo(Priority::class);
    }

    // Request has many Comments (One-to-Many)
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Request has many Approvers (One-to-Many)
    public function approvers() {
        return $this->hasMany(Approver::class);
    }
}
