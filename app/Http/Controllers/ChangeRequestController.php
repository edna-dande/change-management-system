<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequest;
use App\Models\Priority;
use App\Models\Status;
use App\Models\System;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeRequestController extends Controller
{
    public function index()
    {
        $changeRequests = ChangeRequest::all();
        return view('change_requests.index', compact('changeRequests'));
    }
    public function show()
    {
        $changeRequest = ChangeRequest::orderBy('id','DESC')->get();
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
            'system_id' => 'required',
//             'status_id' => 'required',
            'objective' => 'required',
            'current_process' => 'required',
            'proposed_process' => 'required',
            // 'user_id' => 'required',
            // 'priority_id' => 'required',
        ]);

        $validatedData['user_id'] = Auth::id();

        $changeRequest = ChangeRequest::create($validatedData);

        $changeRequest->save();

        return redirect()->route('change_requests')
            ->with('success', 'Change request created successfully!');
    }
    public function edit($id)
    {
        $changeRequest = ChangeRequest::findOrFail($id);
        return view('change_requests.edit', compact('changeRequest'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'system_id' => 'required',
            'status_id' => 'required',
            'objective' => 'required',
            'current_process' => 'required',
            'proposed_process' => 'required',
            'user_id' => 'required',
            'priority_id' => 'required',
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
}
