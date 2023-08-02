<x-app-layout>

    <div class="container crequest">
        <h1>Change Request Details</h1>
        <div class="card mb-3 custom-card">
            <div class="card-body custom-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-2">
                                <p class="card-text"><strong>From:</strong></p>
                                <p class="card-text"><strong>Date:</strong></p>
                                <p class="card-text"><strong>Title:</strong></p>
                                <p class="card-text"><strong>System:</strong></p>
                                <p class="card-text"><strong>Status:</strong></p>
                            </div>
                            <div class="col-md-10">
                                <p>{{ $changeRequest->user->name }}</p>
                                <p>{{ $changeRequest->created_at }}</p>
                                <p>{{ $changeRequest->title }}</p>
                                <p>{{ $changeRequest->system->name }}</p>
                                <p>{{ $changeRequest->status->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 priority">
                        @if($changeRequest->priority && $changeRequest->priority->name == "low")
                            <button class="btn btn-success">{{ ucfirst($changeRequest->priority->name) }} Priority</button>
                        @elseif($changeRequest->priority && $changeRequest->priority->name == "medium")
                            <button class="btn btn-warning">{{ ucfirst($changeRequest->priority->name) }} Priority</button>
                        @else
                            <button class="btn btn-danger">{{ ucfirst($changeRequest->priority->name) }} Priority</button>
                        @endif
                    </div>
                </div>
                <div class="row">
                </div>
                <p class="card-text"><strong>Objective:</strong></p>
                <p>{{ $changeRequest->objective }}</p>
                <p class="card-text"><strong>Current Process:</strong></p>
                <p>{{ $changeRequest->current_process }}</p>
                <p class="card-text"><strong>Proposed Process:</strong></p>
                <p>{{ $changeRequest->proposed_process }}</p>

                <p class="card-text"><strong>Approval Status:</strong></p>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Approval Type</th>
                                <th>Status</th>
                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>BSA Approval</td>
                                <td><span class="btn {{ $changeRequest->bsaApproval ? ($changeRequest->bsaApproval->status_id == 6 ? 'btn-approved' : 'btn-rejected') : '' }}">{{ $changeRequest->bsaApproval ? $changeRequest->bsaApproval->status?->name : '' }}</span></td>
                                <td>{{ $changeRequest->bsaApproval ? $changeRequest->bsaApproval->reason : '' }}</td>
                            </tr>
                            <tr>
                                <td>Design Approval</td>
                                <td><span class="btn {{ $changeRequest->designApproval ? ($changeRequest->designApproval->status_id == 6 ? 'btn-approved' : 'btn-rejected') : '' }}">{{ $changeRequest->designApproval ? $changeRequest->designApproval->status?->name : '' }}</span></td>
                                <td>{{ $changeRequest->designApproval ? $changeRequest->designApproval->reason : '' }}</td>
                            </tr>
                            <tr>
                                <td>Tech Lead Approval</td>
                                <td><span class="btn {{ $changeRequest->techLeadApproval ? ($changeRequest->techLeadApproval->status_id == 6 ? 'btn-approved' : 'btn-rejected') : '' }}">{{ $changeRequest->techLeadApproval ? $changeRequest->techLeadApproval->status?->name : '' }}</span></td>
                                <td>{{ $changeRequest->techLeadApproval ? $changeRequest->techLeadApproval->reason : '' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($userCanApprove)
                    <form action="{{ route('change_requests.approval', $changeRequest->id) }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-group" style="margin-top: 20px;">
                            <textarea name="reason" id="reason" class="form-control" rows="2" placeholder="Please enter reason..."></textarea>
                        </div>
                        <div class="row approval" style="margin-top: 20px;">
                            <div class="col-md-6 text-center">
                                <button type="submit" name="action" value="decline" class="btn btn-outline-danger">Decline</button>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                            </div>
                        </div>
                    </form>

                    {{--                            <form action="{{ route('change_requests.reject', $changeRequest->id) }}" method="POST">--}}

                @endif
                @if ($assign)
                    <a href="{{ route('change_requests.assign', $changeRequest->id) }}" class="btn btn-primary">Assign</a>
                @endif
            </div>
        </div>
        <!-- Comments Section -->
        <div class="card mb-3">
            <div class="card-header">
                <h5>Comments</h5>
            </div>
            <div class="card-body">

                @if (count($changeRequest->comments) > 0)
                    <div>
                        @foreach ($changeRequest->comments as $comment)
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="letter-image text-center">
                                        {{ strtoupper($comment->user->name[0]) }}
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <p style="margin-bottom: unset"><span style="font-size: 24px; font-weight: bolder; color: gray;">{{ $comment->user->name }} </span><span style="font-size: 10px;">{{ $comment->created_at }}</span></p>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @else
                    <p>No comments yet.</p>
                @endif
                @if(auth()->user()->id === $changeRequest->user_id || auth()->user()->hasRole('business analyst') || auth()->user()->hasRole('design') || auth()->user()->hasRole('tech lead'))
                    <form action="{{ route('change_requests.comments', ['changeRequest' => $changeRequest->id]) }}" method="POST">
                        @csrf
                        <div class="row ">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <!-- <label for="content">Add Comment</label> -->
                                    <input name="content" id="content" class="form-control" style="border-radius: 30px; height: 50px;" placeholder="Add Comment ..." required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" style="border-radius: 30px; height: 50px;">Send</button></div>
                        </div>
                        <!-- <div class="input-group mb-3">
                            <input type="text" name="content" id="content" class="form-control form-control-lg mr-6 rounded-sm" placeholder="Add comment..." aria-label="Comment" aria-describedby="comment-button" required>
                            <button class="btn btn-primary rounded-lg" type="submit" >Send</button>
                        </div> -->

                    </form>
                @endif
            </div>
        </div>


    </div>

</x-app-layout>
