<x-app-layout>
    <div class="container crequest">
        <h1>Assign Change Request to Developer</h1>
        <form method="POST" action="{{ route('change_requests.assign.developer', $changeRequest->id) }}">
            @csrf
            <div class="form-group">
                <label for="developer">Select Developer:</label>
                <select name="developer" id="developer" class="form-control" required>
                    @foreach($developers as $developer)
                        <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="completion_date">Completion Date:</label>
                <input type="date" name="completion_date" id="completion_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Assign Request</button>
        </form>
    </div>
</x-app-layout>
