<x-app-layout>

        <div class="container">
            <h1>Change Request Details</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $changeRequest->title }}</h5>
                    <p class="card-text"><strong>System:</strong> {{ $changeRequest->system->name }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $changeRequest->status->name }}</p>
                    <p class="card-text"><strong>Priority:</strong> {{ $changeRequest->priority->name }}</p>
                    <p class="card-text"><strong>Objective:</strong></p>
                    <p>{{ $changeRequest->objective }}</p>
                    <p class="card-text"><strong>Current Process:</strong></p>
                    <p>{{ $changeRequest->current_process }}</p>
                    <p class="card-text"><strong>Proposed Process:</strong></p>
                    <p>{{ $changeRequest->proposed_process }}</p>
                    <p class="card-text"><strong>Requesting User:</strong> {{ $changeRequest->user->name }}</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5>Approval Status</h5>
                </div>
                <div class="card-body">
                    <p><strong>BSA Approval:</strong> {{ $changeRequest->bsa_approval }}</p>
                    <p><strong>Design Approval:</strong> {{ $changeRequest->design_approval }}</p>
                    <p><strong>Tech Lead Approval:</strong> {{ $changeRequest->tech_lead_approval }}</p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Comments</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store', ['change_request' => $changeRequest->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Add Comment</label>
                            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                    @if (count($changeRequest->comments) > 0)
                        <ul>
                            @foreach ($changeRequest->comments as $comment)
                                <li>{{ $comment->content }} - by {{ $comment->user->name }} at {{ $comment->created_at }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No comments yet.</p>
                    @endif
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5>Timestamps</h5>
                </div>
                <div class="card-body">
                    <p><strong>Created At:</strong> {{ $changeRequest->created_at }}</p>
                    <p><strong>Updated At:</strong> {{ $changeRequest->updated_at }}</p>
                </div>
            </div>
        </div>

</x-app-layout>
