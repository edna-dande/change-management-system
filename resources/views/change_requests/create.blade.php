<x-app-layout>
        <div class="container crequest">
            <h1>Create Request</h1>
            <p>Fill in sections to create request</p>
            <form action="{{ route('change_requests.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title<span class="required">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Type your Title here..." required>
                </div>
                <div class="form-group">
                    <label for="system_id">System</label>
                    <select name="system_id" id="system_id" class="form-control" required>
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}">{{ $system->name }}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="status_id">Status</label>--}}
{{--                    <select name="status_id" id="status_id" class="form-control" required>--}}
{{--                        @foreach ($statuses as $status)--}}
{{--                            <option value="{{ $status->id }}">{{ $status->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="priority_id">Priority</label>--}}
{{--                    <select name="priority_id" id="priority_id" class="form-control" required>--}}
{{--                        @foreach ($priorities as $priority)--}}
{{--                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="objective">Objective<span class="required">*</span></label>
                    <textarea name="objective" id="objective" class="form-control" rows="4" placeholder="Type your Objective here..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="current_process">Current Process<span class="required">*</span></label>
                    <textarea name="current_process" id="current_process" class="form-control" rows="4" placeholder="Type current process here..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="proposed_process">Proposed Process<span class="required">*</span></label>
                    <textarea name="proposed_process" id="proposed_process" class="form-control" rows="4" placeholder="Type proposed process here..." required></textarea>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="user_id">Requesting User</label>--}}
{{--                    <select name="user_id" id="user_id" class="form-control" required>--}}
{{--                        @foreach ($users as $user)--}}
{{--                            <option value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="d-grid gap-2" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" style="">Create Request</button>
                </div>
            </form>
        </div>
</x-app-layout>
