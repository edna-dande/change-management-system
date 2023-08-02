<?php

namespace App\Console\Commands;

use App\Models\ChangeRequest;
use App\Notifications\ChangeRequestPendingReminderNotification;
use Illuminate\Console\Command;

class SendPendingApprovalsReminder extends Command
{

    protected $signature = 'reminders:send';

    protected $description = 'Send reminders to pending approvers for change requests';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingChangeRequests = ChangeRequest::with('approvals.approvalLevel')
            ->whereHas('approvals', function ($query) {
                $query->where('status', 'pending');
            })
            ->get();

        foreach ($pendingChangeRequests as $changeRequest) {
            $nextPendingApproval = $changeRequest->getNextPendingApprovalAttribute();

            $approver = $changeRequest->getApproverForApproval($nextPendingApproval);

            if ($approver) {
                $approver->notify(new ChangeRequestPendingReminderNotification($changeRequest));
            }
        }
        $this->info('Reminders sent successfully.');
    }
}
