<x-app-layout>
    <div class="container">
        <h2>Approver Dashboard</h2>
        @if(count($pendingChangeRequests) > 0)
            <ul>
                @foreach($pendingChangeRequests as $changeRequest)
                    <li>
                        {{ $changeRequest->title }}
                        <a href="{{ route('approver.approval.view', $changeRequest->id) }}">Review</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No pending change requests for approval.</p>
        @endif
    </div>
</x-app-layout>

