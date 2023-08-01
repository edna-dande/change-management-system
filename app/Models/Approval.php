<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'change_request_id',
        'reason',
        'status_id',
        'approval_level_id',
        'status'
        ];


    public function changeRequest() {
        return $this->belongsTo(ChangeRequest::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function approvalLevel() {
        return $this->belongsTo(ApprovalLevel::class, 'approval_level_id');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }


}
