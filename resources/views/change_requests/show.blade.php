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
                            </tr>
                            </thead>
                            <tr>
                                <td>BSA Approval</td>
                                <td>{{ $changeRequest->bsa_approval }}</td>
                            </tr>
                            <tr>
                                <td>Design Approval</td>
                                <td>{{ $changeRequest->design_approval }}</td>
                            </tr>
                            <tr>
                                <td>Tech Lead Approval</td>
                                <td>{{ $changeRequest->tech_lead_approval }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if($userCanApprove)

                    <div class="row approval">
                        <div class="col-md-6 text-center">
                            <!-- <div class="d-grid gap-2 mt-3"> -->
                            <button type="button" class="btn btn-outline-danger">Decline</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success">Approve</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Comments Section -->
        <div class="card mb-3">
            <div class="card-header">
                @if(auth()->user()->id === $changeRequest->user_id || auth()->user()->role === 'business analyst' || auth()->user()->role === 'design' || auth()->user()->role === 'tech lead')
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
            </div>
            @endif
        </div>


    </div>

</x-app-layout>
