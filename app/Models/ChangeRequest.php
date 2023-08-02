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

    public function developer() {
        return $this->belongsTo(User::class, 'assigned_to');
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

    public function isFullyApproved()
    {
        return $this->approvals->where('status', 'approved')->count() === 3;
    }

    public function approvalLevels()
    {
        return $this->belongsToMany(ApprovalLevel::class, 'approvals');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    public function bsaApproval()
    {
        return $this->hasOne(Approval::class)->where('approval_level_id', 1);
    }

    public function designApproval()
    {
        return $this->hasOne(Approval::class)->where('approval_level_id', 2);
    }

    public function techLeadApproval()
    {
        return $this->hasOne(Approval::class)->where('approval_level_id', 3);
    }

    public function bsaApprovalStatus()
    {
        return $this->whereHas('bsaApproval',
            function ($query) {
                $query->where('status_id', 6);
            })->where('id', $this->id)->get();
    }

    public function bsaRejectionStatus()
    {
        return $this->whereHas('bsaApproval',
            function ($query) {
                $query->where('status_id', 5);
            })->where('id', $this->id)->get();
    }

    public function designApprovalStatus()
    {
        return $this->whereHas('designApproval',
            function ($query) {
                $query->where('status_id', 6);
            })->where('id', $this->id)->get();
    }

    public function designRejectionStatus()
    {
        return $this->whereHas('designApproval',
            function ($query) {
                $query->where('status_id', 5);
            })->where('id', $this->id)->get();
    }

    public function techLeadApprovalStatus()
    {
        return $this->whereHas('techLeadApproval',
            function ($query) {
                $query->where('status_id', 6);
            })->where('id', $this->id)->get();
    }

    public function techLeadRejectionStatus()
    {
        return $this->whereHas('techLeadApproval',
            function ($query) {
                $query->where('status_id', 5);
            })->where('id', $this->id)->get();
    }

    public function getNextPendingApprovalAttribute()
    {
//        dd($this->developer);
        $bsaApproval = $this->bsaApprovalStatus()->first();
        $bsaRejection = $this->bsaRejectionStatus()->first();
        $designApproval = $this->designApprovalStatus()->first();
        $designRejection = $this->designRejectionStatus()->first();
        $techLeadApproval = $this->techLeadApprovalStatus()->first();
        $techLeadRejection = $this->techLeadRejectionStatus()->first();
        $assigned = $this->developer;

        if ($bsaRejection || $designRejection || $techLeadRejection) {
            return null;
        } else if ($assigned && $this->status_id == 4) {
            return null;
        } else if ($assigned) {
            return 'developer';
        } else if ($techLeadApproval) {
            return 'assign';
        } else if ($designApproval) {
            return 'tech_lead';
        } else if ($bsaApproval) {
            return 'design';
        } else {
            return 'bsa';
        }
    }

    public function getApprovalStatusAttribute()
    {
        $bsaApproval = $this->bsaApproval;
        $designApproval = $this->designApproval;
        $techLeadApproval = $this->techLeadApproval;

        if($bsaApproval && $designApproval && $techLeadApproval) {
            return 'approved';
        } else if ($bsaApproval) {
            return 'in-progress';
        } else {
            return 'pending';
        }
    }

//    public function getApprovalStatusAttribute()
//    {
//        $currentStatus = $this->status_id;
//
//        // Define the status IDs that represent different approval stages
//        $bsaApprovalStatusId = 2;
//        $designApprovalStatusId = 3;
//        $techLeadApprovalStatusId = 4;
//
//        if ($currentStatus === $bsaApprovalStatusId) {
//            return 'Pending BSA Analyst Approval';
//        } elseif ($currentStatus === $designApprovalStatusId) {
//            return 'Pending Design Approval';
//        } elseif ($currentStatus === $techLeadApprovalStatusId) {
//            return 'Pending Tech Lead Approval';
//        } elseif ($currentStatus === 5) {
//            // For example, status ID 5 represents fully approved status
//            return 'Fully Approved';
//        } else {
//            // If the status ID does not match any of the approval stages, return a custom status
//            return 'Approval In Progress';
//        }


}
