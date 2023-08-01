<x-app-layout>
    <div class="container crequest">
        <h1>Assign Change Request to Developer</h1>
        <form method="POST" action="{{ route('change_requests.assign.developer', $changeRequest->id) }}">
            @csrf
            <div class="form-group">
                <label for="developer">Assign to Developer:</label>
                <select name="developer" id="developer" class="form-control">
                    @foreach($developers as $developer)
                        <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="completion_date">Completion Date:</label>
                <input type="date" name="completion_date" id="completion_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Assign to Developer</button>
        </form>
    </div>
</x-app-layout>
