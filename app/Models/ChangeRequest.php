<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'system_id',
        'status_id',
        'objective',
        'current_process',
        'proposed_process',
        'user_id',
        'priority_id',
        ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // ChangeRequest belongs to System (Many-to-One)
    public function system() {
        return $this->belongsTo(System::class);
    }

    // ChangeRequest belongs to Status (Many-to-One)
    public function status() {
        return $this->belongsTo(Status::class);
    }

    // ChangeRequest belongs to Priority (Many-to-One)
    public function priority() {
        return $this->belongsTo(Priority::class);
    }

    // ChangeRequest has many Comments (One-to-Many)
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getApprovalStatusAttribute()
    {
        $currentStatus = $this->status_id;

        // Define the status IDs that represent different approval stages
        $bsaApprovalStatusId = 2;
        $designApprovalStatusId = 3;
        $techLeadApprovalStatusId = 4;

        if ($currentStatus === $bsaApprovalStatusId) {
            return 'Pending BSA Analyst Approval';
        } elseif ($currentStatus === $designApprovalStatusId) {
            return 'Pending Design Approval';
        } elseif ($currentStatus === $techLeadApprovalStatusId) {
            return 'Pending Tech Lead Approval';
        } elseif ($currentStatus === 5) {
            // For example, status ID 5 represents fully approved status
            return 'Fully Approved';
        } else {
            // If the status ID does not match any of the approval stages, return a custom status
            return 'Approval In Progress';
        }

    }
}
