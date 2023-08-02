<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalLevel;
use App\Models\ChangeRequest;
use App\Models\Comment;
use App\Models\Priority;
use App\Models\Role;
use App\Models\Status;
use App\Models\System;
use App\Models\User;
use App\Notifications\ChangeRequestApprovedNotification;
use App\Notifications\ChangeRequestAssignedNotification;
use App\Notifications\ChangeRequestRejectedNotification;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ChangeRequestController extends Controller
{
    public function index(Request $request)
    {

        $search_input = $request->query('search_input');
        $search_status_id = $request->query('search_status_id');

//        $changeRequests = ChangeRequest::where('title', 'like', '%' . $search_input . '%')
//            ->where('status_id', $search_status_id)
//            ->orderBy('id','DESC')
//            ->get();

        $changeRequestQuery = ChangeRequest::query();

        if($search_input) {
            $changeRequestQuery = $changeRequestQuery->where('title', 'like', '%' . $search_input . '%');
        }

        if($search_status_id) {
            $changeRequestQuery = $changeRequestQuery->where('status_id', $search_status_id);
        }

        $changeRequests = $changeRequestQuery->orderBy('id','DESC')->get();

        $changeRequests->load('user', 'system', 'status', 'priority');
        $statuses = Status::all();

        return view('change_requests.index', compact('changeRequests', 'statuses'));
    }

    public function show(ChangeRequest $changeRequest)
    {
        $changeRequest->load('user', 'system', 'status', 'priority');

        $userType = 'user';

        $user = Auth::user();
        $userCanApprove = false;
        $assign = false;

        $nextPendingApproval = $changeRequest->nextPendingApproval;

//        dd($nextPendingApproval);
        $changeRequest->approvalStatus;

        if ($nextPendingApproval == 'bsa' && $user->hasRole('business analyst')) {
            $userCanApprove = true;
        } else if ($nextPendingApproval == 'design' && $user->hasRole('design')) {
            $userCanApprove = true;
        } else if ($nextPendingApproval == 'tech_lead' && $user->hasRole('tech lead')) {
            $userCanApprove = true;
        } else if ($nextPendingApproval == 'assign' && $user->hasRole('tech lead')) {
            $assign = true;
        }

        return view('change_requests.show', compact('changeRequest', 'userType', 'userCanApprove', 'assign'));

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


        $validatedData = $request->validate([
            'title' => 'required',
            'system_id' => 'required|exists:systems,id',
//             'status_id' => 'required|exists:statuses,id',
            'objective' => 'required',
            'current_process' => 'required',
            'proposed_process' => 'required',
            // 'user_id' => 'required',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['status_id'] = 1;

        $changeRequest = ChangeRequest::create($validatedData);

        $approvalLevels = ApprovalLevel::all();

//        foreach ($approvalLevels as $approvalLevel) {
//            $approval = new Approval(['approval_level_id' => $approvalLevel->id]);
//            $changeRequest->approvals()->save($approval);
//        }

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



    public function approval(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);
        // Check if the user is authorized to approve /decline (you can add additional checks here)

        if (Auth::user()->hasRole('business analyst')) {
            $approvalId = 1;
        } elseif (Auth::user()->hasRole('design')) {
            $approvalId = 2;
        } elseif (Auth::user()->hasRole('tech lead')) {
            $approvalId = 3;
        }
        switch ($request->input('action')) {
            case 'approve':
                $approval = new Approval([
                    'change_request_id' => $changeRequest->id,
                    'approval_level_id' => $approvalId,
                    'user_id' => Auth::id(),
                    'status_id' => 6,
                    'reason' => $request->input('reason'),
                ]);

                $approval->save();
                if (Auth::user()->hasRole('business analyst')) {
                    $changeRequest->status_id = 2;
                    $changeRequest->update();
                } elseif (Auth::user()->hasRole('design')) {
                    $changeRequest->status_id = 3;
                    $changeRequest->update();
                } elseif (Auth::user()->hasRole('tech lead')) {
                    $changeRequest->status_id = 6;
                    $changeRequest->update();
                }

                $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));

                $business_analysts = User::whereHas('roles',
                    function ($query) {
                        $query->where('name', 'business_analyst')
                            ->orWhere('name', 'business analyst');
                    })->get();
                $designs = User::whereHas('roles',
                    function ($query) {
                        $query->where('name', 'design');
                    })->get();
                $tech_leads = User::whereHas('roles',
                    function ($query) {
                        $query->where('name', 'tech_lead')
                            ->orWhere('name', 'tech lead');
                    })->get();

                $approvers = $business_analysts->merge($designs)->merge($tech_leads);

//                dd($approvers);

                Notification::send($approvers, new ChangeRequestApprovedNotification($changeRequest));

                break;

            case 'decline':

                $validatedData = $request->validate([
                    'reason' => 'required',
                ]);

                $validatedData['change_request_id'] = $changeRequest->id;
                $validatedData['approval_level_id'] = $approvalId;
                $validatedData['user_id'] = Auth::id();
                $validatedData['status_id'] = 5;

                $approval = new Approval($validatedData);

                $approval->save();

                $changeRequest->status_id = 5;
                $changeRequest->update();

                $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));

                $business_analysts = User::whereHas('roles',
                    function ($query) {
                        $query->where('name', 'business_analyst')
                            ->orWhere('name', 'business analyst');
                    })->get();
                $designs = User::whereHas('roles',
                    function ($query) {
                        $query->where('name', 'design');
                    })->get();
                $tech_leads = User::whereHas('roles',
                    function ($query) {
                        $query->where('name', 'tech_lead')
                            ->orWhere('name', 'tech lead');
                    })->get();

                $approvers = $business_analysts->merge($designs)->merge($tech_leads);

                Notification::send($approvers, new ChangeRequestRejectedNotification($changeRequest));

                break;
        }

        return redirect()->route('change_requests.show', $changeRequest->id)
            ->with('success', 'Change request updated successfully.');
    }

    public function storeComment(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        $comment = new Comment([
            'change_request_id' => $changeRequest->id,
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        $changeRequest = ChangeRequest::findOrFail($id);

        $changeRequest->comments()->save($comment);

        $changeRequest->user->notify(new NewCommentNotification($comment));

        $business_analysts = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'business_analyst')
                    ->orWhere('name', 'business analyst');
            })->get();
        $designs = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'design');
            })->get();
        $tech_leads = User::whereHas('roles',
            function ($query) {
                $query->where('name', 'tech_lead')
                    ->orWhere('name', 'tech lead');
            })->get();

        $approvers = $business_analysts->merge($designs)->merge($tech_leads);

        // dd($approvers);

        Notification::send($approvers, new NewCommentNotification($comment));

        return redirect()->route('change_requests.show', $changeRequest->id)
            ->with('success', 'Comment added successfully.');
    }

    public function showAssignForm($id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        if ($changeRequest->nextPendingApproval  != 'assign' || !Auth::user()->hasRole('tech lead')) {
            abort(403, 'Unauthorized action.');
        }

        $developers = Role::where('name', 'developer')->firstOrFail()->users;

        return view('change_requests.assign_form', compact('changeRequest', 'developers'));
    }

    public function assignDeveloper(Request $request, $id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);

        if ($changeRequest->nextPendingApproval  != 'assign' || !Auth::user()->hasRole('tech lead')) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'developer' => 'required|exists:users,id',
            'completion_date' => 'required|date',
        ]);

        $developer = User::findOrFail($validatedData['developer']);

        if (!$developer->hasRole('developer')) {
            return redirect()->route('change_requests.show', $changeRequest->id)
                ->with('error', 'Selected user is not a developer.');
        }

        $changeRequest->assigned_to = $developer->id;
        $changeRequest->completion_date = $validatedData['completion_date'];
        $changeRequest->status_id = 7;

        $changeRequest->update();

        $developer->notify(new ChangeRequestAssignedNotification($changeRequest));

        return redirect()->route('change_requests.show', $changeRequest->id)
            ->with('success', 'Change request assigned to developer successfully.');
    }

//    public function approverDashboard()
//    {
//        // Retrieve pending change requests for the current approver
//        $pendingChangeRequests = ChangeRequest::with(['approvals.approvalLevel'])
//            ->whereHas('approvals', function ($query) {
//                $query->where('user_id', auth()->user()->id)
//                    ->where('status', 'pending');
//            })
//            ->get();
//
//        return view('change_requests.approver_dashboard', compact('pendingChangeRequests'));
//    }
//
//    public function viewApproverApproval(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        // Check if the user is authorized to view the approval (you can add additional checks here)
//
//        return view('change_requests.approver_approval', compact('changeRequest'));
//    }
//
//    public function approveBusinessAnalyst(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        $changeRequest->update(['status_id' => 2]);
//
//        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));
//
//        return redirect()->route('change_requests.approver.dashboard')
//            ->with('success', 'Change request approved successfully.');
//    }
//    public function rejectBusinessAnalyst(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        $changeRequest->update(['status_id' => 5]);
//
//        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));
//
//        return redirect()->route('change_requests.approver.dashboard')
//            ->with('success', 'Change request rejected successfully.');
//    }
//
//    public function approveDesign(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        $changeRequest->update(['status_id' => 3]);
//
//        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));
//
//        return redirect()->route('change_requests.approver.dashboard')
//            ->with('success', 'Change request approved successfully.');
//    }
//
//    public function rejectDesign(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        $changeRequest->update(['status_id' => 5]);
//
//        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));
//
//        return redirect()->route('change_requests.approver.dashboard')
//            ->with('success', 'Change request rejected successfully.');
//    }
//
//    public function approveTechLead(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        $changeRequest->update(['status_id' => 4]);
//
//        $changeRequest->user->notify(new ChangeRequestApprovedNotification($changeRequest));
//
//        return redirect()->route('change_requests.approver.dashboard')
//            ->with('success', 'Change request approved successfully.');
//    }
//
//    public function rejectTechLead(Request $request, $id)
//    {
//        $changeRequest = ChangeRequest::findOrFail($id);
//
//        $changeRequest->update(['status_id' => 5]);
//
//        $changeRequest->user->notify(new ChangeRequestRejectedNotification($changeRequest));
//
//        return redirect()->route('change_requests.approver.dashboard')
//            ->with('success', 'Change request rejected successfully.');
//    }

}
