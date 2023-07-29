<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, ChangeRequest $changeRequest)
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        // Associate the comment with the specific change request
        $comment = new Comment($validatedData);
        $comment->change_request_id = $changeRequest->id;
        $comment->save();

        return redirect()->route('change_requests.show', $changeRequest->id)
            ->with('success', 'Comment added successfully!');
    }
}
