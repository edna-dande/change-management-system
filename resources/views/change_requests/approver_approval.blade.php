<x-app-layout>
        <div class="container">
            <h2>Approver Approval</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $changeRequest->title }}</h5>
                    <p class="card-text">System: {{ $changeRequest->system->name }}</p>
                    <p class="card-text">Status: {{ $changeRequest->status->name }}</p>
                    <p class="card-text">Priority: {{ $changeRequest->priority->name }}</p>
                    <!-- Add other fields as needed -->

                    <hr>

                    <h5>Approvals</h5>
                    <ul>
                        @foreach($changeRequest->approvals as $approval)
                            <li>{{ $approval->approvalLevel->type }} Approval: {{ $approval->status }}</li>
                        @endforeach
                    </ul>

                    <hr>

                    <h5>Comments</h5>
                    @foreach($changeRequest->comments as $comment)
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="card-text">User: {{ $comment->user->name }}</p>
                                <p class="card-text">Comment: {{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Form for approving or rejecting -->
                    <form action="{{ route('change_requests.approve', $changeRequest->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reason">Reason for Approval (Optional):</label>
                            <textarea name="reason" id="reason" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>

                    <form action="{{ route('change_requests.reject', $changeRequest->id) }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="reason">Reason for Rejection (Optional):</label>
                            <textarea name="reason" id="reason" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
