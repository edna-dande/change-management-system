<x-app-layout>
    <div class="container">
        <h1>Edit Change Request</h1>
        <form action="{{ route('change_requests.update', $changeRequest->id) }}" method="POST">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $changeRequest->title }}" required>
            </div>
            <div class="form-group">
                <label for="system_id">System</label>
                <select name="system_id" id="system_id" class="form-control" required>
                    @foreach ($systems as $system)
                        <option value="{{ $system->id }}" @if ($changeRequest->system_id == $system->id) selected @endif>{{ $system->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status_id">Status</label>
                <select name="status_id" id="status_id" class="form-control" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" @if ($changeRequest->status_id == $status->id) selected @endif>{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="priority_id">Priority</label>
                <select name="priority_id" id="priority_id" class="form-control" required>
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}" @if ($changeRequest->priority_id == $priority->id) selected @endif>{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="objective">Objective</label>
                <textarea name="objective" id="objective" class="form-control" rows="4" required>{{ $changeRequest->objective }}</textarea>
            </div>
            <div class="form-group">
                <label for="current_process">Current Process</label>
                <textarea name="current_process" id="current_process" class="form-control" rows="4" required>{{ $changeRequest->current_process }}</textarea>
            </div>
            <div class="form-group">
                <label for="proposed_process">Proposed Process</label>
                <textarea name="proposed_process" id="proposed_process" class="form-control" rows="4" required>{{ $changeRequest->proposed_process }}</textarea>
            </div>
            <div class="form-group">
                <label for="user_id">Requesting User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($changeRequest->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-app-layout>
