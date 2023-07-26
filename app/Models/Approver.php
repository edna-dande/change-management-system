<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;

    // Approver belongs to Request (Many-to-One)
    public function request() {
        return $this->belongsTo(Request::class);
    }

    // Approver belongs to User (Many-to-One)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Approver belongs to Approval (Many-to-One)
    public function approval() {
        return $this->belongsTo(Approval::class);
    }

    // Approver belongs to Status (Many-to-One)
    public function status() {
        return $this->belongsTo(Status::class);
    }
}
