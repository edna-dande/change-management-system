<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLevel extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'approval_levels_users');
    }

    public function changeRequests()
    {
        return $this->belongsToMany(ChangeRequest::class, 'approvals');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
}
