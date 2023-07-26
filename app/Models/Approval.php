<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    // Approval has many Approvers (One-to-Many)
    public function approvers() {
        return $this->hasMany(Approver::class);
    }
}
