<x-app-layout>
    <div class="container">
        <h1>BSA Approval</h1>
        <form action="{{ route('approve.bsa', $changeRequest->id) }}" method="POST">
            @csrf
            <label for="approval_status">Approval Status:</label>
            <select name="approval_status" id="approval_status">
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            <br>
            <label for="reason">Reason (if rejected):</label>
            <textarea name="reason" id="reason" rows="4"></textarea>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
</x-app-layout>
