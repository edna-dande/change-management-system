<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalLevel;
use App\Models\ChangeRequest;
use App\Models\Comment;
use App\Models\Priority;
use App\Models\Status;
use App\Models\System;
use App\Models\User;
use App\Notifications\ChangeRequestApprovedNotification;
use App\Notifications\ChangeRequestRejectedNotification;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ChangeRequestController extends Controller
{
    public function index()
    {
        $business_analysts = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'business analyst');
            })->get();
        $designs = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'design');
            })->get();
        $tech_leads = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'tech_lead');
            })->get();

        $approvers = $business_analysts->merge($designs)->merge($tech_leads);

//        dd($approvers);
//        $changeRequests = ChangeRequest::with('user', 'system', 'status', 'priority')->get();
        $changeRequests = ChangeRequest::all();
        $changeRequests->load('user', 'system', 'status', 'priority');
        return view('change_requests.index', compact('changeRequests'));
    }
    public function show(ChangeRequest $changeRequest)
    {
          $changeRequest->load('user', 'system', 'status', 'priority');
//        $changeRequest = ChangeRequest::orderBy('id','DESC')->get();
//        $changeRequest = ChangeRequest::with(['approvals.approvalLevel', 'comments.user'])
//            ->findOrFail($id);
//        dd($changeRequest);
        return view('change_requests.show', compact('changeRequest'));

    }
    public function create()
    {
        $users = User::all();
        $systems = System::all();
        $statuses = Status::all();
        $priorities = Priority::all();

        return view('change_requests.create', compact('systems', 'statuses', 'priorities', 'users'));
    }
    public function store(Request $request)
    {
        $validatedData['user_id'] = Auth::id();

        $validatedData = $request->validate([
            'title' => 'required',
            'system_id' => 'required|exists:systems,id',
//             'status_id' => 'required|exists:statuses,id',
            'objective' => 'required',
            'current_process' => 'required',
            'proposed_process' => 'required',
            // 'user_id' => 'required',
            // 'priority_id' => 'required|exists:priorities,id',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['status_id'] = 1;

        $changeRequest = ChangeRequest::create($validatedData);

        $approvalLevels = ApprovalLevel::all();

        foreach ($approvalLevels as $approvalLevel) {
            $approval = new Approval(['approval_level_id' => $approvalLevel->id]);
            $changeRequest->approvals()->save($approval);
        }

        $changeRequest->save();

        return redirect()->route('change_requests')
            ->with('success', 'Change request created successfully!');
    }
    public function edit($id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);
        $systems = System::all();
        $statuses = Status::all();
        $priorities = Priority::all();

        return view('change_requests.edit', compact('changeRequest', 'systems', 'statuses', 'priorities'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'system_id' => 'required|exists:systems,id',
            'status_id' => 'required|exists:statuses,id',
            'objective' => 'required',
            'current_process' => 'required',
            'proposed_process' => 'required',
//            'user_id' => 'required',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update($validatedData);

        return redirect()->route('change_requests')
            ->with('success', 'Change request updated successfully!');
    }
    public function destroy($id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->delete();

        return redirect()->route('change_requests')
            ->with('success', 'Change request deleted successfully!');
    }

    public function approve(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        // Check if the user is authorized to approve (you can add additional checks here)

        $approval = new Approval([
            'change_request_id' => $changeRequest->id,
            'approval_level_id' => 1,
            'user_id' => auth()->user()->id,
            'status' => 'approved',
            'reason' => $request->input('reason'),
        ]);

        $approval->save();

        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));

        // Update the change request status based on all approvals (e.g., 'approved', 'rejected', 'pending')

        // Redirect back to the change request details page with a success message
        return redirect()->route('change_requests.approver.dashboard', $changeRequest->id)
            ->with('success', 'Change request approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        // Check if the user is authorized to reject (you can add additional checks here)

        $approval = new Approval([
            'change_request_id' => $changeRequest->id,
            'approval_level_id' => 1, // Replace with the appropriate approval level ID (e.g., 1 for BSA Approval)
            'user_id' => auth()->user()->id,
            'status' => 'rejected',
            'reason' => $request->input('reason'),
        ]);

        $approval->save();

        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));

        // Update the change request status based on all approvals (e.g., 'approved', 'rejected', 'pending')

        // Redirect back to the change request details page with a success message
        return redirect()->route('change_requests.show', $changeRequest->id)
            ->with('success', 'Change request rejected successfully.');
    }

    public function storeComment(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        // Validate the comment data

        $comment = new Comment([
            'change_request_id' => $changeRequest->id,
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->comments()->save($comment);

//        $comment->save();

        $changeRequest->user->notify(new NewCommentNotification($comment));



        $business_analysts = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'business_analyst');
            })->get();
        $designs = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'design');
            })->get();
        $tech_leads = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'tech_lead');
            })->get();

        $approvers = $business_analysts->merge($designs)->merge($tech_leads);

        // dd($approvers);

        Notification::send($approvers, new NewCommentNotification($comment));

        // Redirect back to the change request details page with a success message
        return redirect()->route('change_requests.show', $changeRequest->id)
            ->with('success', 'Comment added successfully.');
    }

    public function approverDashboard()
    {
        // Retrieve pending change requests for the current approver
        $pendingChangeRequests = ChangeRequest::with(['approvals.approvalLevel'])
            ->whereHas('approvals', function ($query) {
                $query->where('user_id', auth()->user()->id)
                    ->where('status', 'pending');
            })
            ->get();

        return view('change_requests.approver_dashboard', compact('pendingChangeRequests'));
    }

    public function viewApproverApproval(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        // Check if the user is authorized to view the approval (you can add additional checks here)

        return view('change_requests.approver_approval', compact('changeRequest'));
    }

    public function approveBusinessAnalyst(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update(['status_id' => 2]);

        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));

        return redirect()->route('change_requests.approver.dashboard')
            ->with('success', 'Change request approved successfully.');
    }
    public function rejectBusinessAnalyst(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update(['status_id' => 5]);

        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));

        return redirect()->route('change_requests.approver.dashboard')
            ->with('success', 'Change request rejected successfully.');
    }

    public function approveDesign(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update(['status_id' => 3]);

        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));

        return redirect()->route('change_requests.approver.dashboard')
            ->with('success', 'Change request approved successfully.');
    }

    public function rejectDesign(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update(['status_id' => 5]);

        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));

        return redirect()->route('change_requests.approver.dashboard')
            ->with('success', 'Change request rejected successfully.');
    }

    public function approveTechLead(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update(['status_id' => 4]);

        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));

        return redirect()->route('change_requests.approver.dashboard')
            ->with('success', 'Change request approved successfully.');
    }

    public function rejectTechLead(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->update(['status_id' => 5]);

        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));

        return redirect()->route('change_requests.approver.dashboard')
            ->with('success', 'Change request rejected successfully.');
    }

}
