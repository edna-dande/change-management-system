<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChangeRequest;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;



class ApprovalController extends Controller
{
    public function bsaApproval(ChangeRequest $changeRequest, Request $request)
    {

        $nextPendingApproval = $changeRequest->nextPendingApproval;

        if ($changeRequest->bsaApproval()->exists()) {
            return redirect()->back()
                ->with('error', 'Request already has bsa approval.');

        } else if ($nextPendingApproval !== 'bsa') {
            return redirect()->back()
                ->with('error', 'Please approve all previous pending approvals first.');
        }

        if (Auth::user()->hasRole('business analyst')) {
            $approval = new Approval([
                'change_request_id' => $changeRequest->id,
                'approval_level_id' => 1,
                'user_id' => Auth::user()->id,
                'reason' => $request->input('reason'),
            ]);

            $approval->save();

            // Update the change request status to "Pending Design Approval"
            $changeRequest->update(['status_id' => 2]); // Assuming 2 is the ID for "Pending Design Approval" in the Statuses table

            // Send notification or any other actions as needed

            return redirect()->back()
                ->with('success', 'BSA Approval submitted successfully!');
        }

        return redirect()->back()
            ->with('error', 'You are not authorized for BSA Approval.');
    }

    public function designApproval(ChangeRequest $changeRequest, Request $request)
    {
        if (Auth::user()->hasRole('Design')) {
            $approval = new Approval([
                'change_request_id' => $changeRequest->id,
                'approval_level_id' => 2, // Assuming 2 is the ID for Design Approval in the Approval_levels table
                'user_id' => Auth::user()->id,
                'reason' => $request->input('reason'),
            ]);

            $approval->save();

            // Update the change request status to "Pending Tech Lead Approval"
            $changeRequest->update(['status_id' => 3]); // Assuming 3 is the ID for "Pending Tech Lead Approval" in the Statuses table

            // Send notification or any other actions as needed

            return redirect()->back()
                ->with('success', 'Design Approval submitted successfully!');
        }

        return redirect()->back()
            ->with('error', 'You are not authorized for Design Approval.');
    }

     public function techLeadApproval(ChangeRequest $changeRequest, Request $request)
     {
         if (Auth::user()->hasRole('Tech Lead')) {
             $approval = new Approval([
                 'change_request_id' => $changeRequest->id,
                 'approval_level_id' => 3,
                 'user_id' => Auth::user()->id,
                 'reason' => $request->input('reason'),
             ]);

             $approval->save();

             // Update the change request status to "Pending Tech Lead Approval"
             $changeRequest->update(['status_id' => 4]);

             // Send notification or any other actions as needed

             return redirect()->back()
                 ->with('success', 'Design Approval submitted successfully!');
         }

         return redirect()->back()
             ->with('error', 'You are not authorized for Design Approval.');
        }

        public function pendingApproval(Request $request)
        {
            // Retrieve pending approval requests based on the user's role (adjust this based on your actual role check logic)
            $pendingRequests = ChangeRequest::where('status_id', 1)->get(); // Assuming "Pending Approval" status ID is 1

            return view('approvals.pending_approval', compact('pendingRequests'));
        }

}

