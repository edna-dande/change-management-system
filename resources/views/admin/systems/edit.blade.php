<x-app-layout>

    {{--        @if(Auth::user()->permissions()->contains('edit_user'))--}}
    <div class="container dashboard">
        <h2>Edit System</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--                @endif--}}
        {{--                @if(Auth::user()->permissions()->contains('update_user'))--}}
        <form action="{{ route('systems.update', $system->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input class="form-control" type="text" name="name" value="{{ $system->name }}" required>
            <br>
            <label for="description">Description:</label>
            <input class="form-control" type="text" name="description" value="{{ $system->description }}" required>
            <br>
            <button type="submit" class="btn btn-primary">Update System</button>
        </form>
    </div>
    {{--        @else--}}
    {{--            <p>Unauthorized</p>--}}
    {{--        @endif--}}
</x-app-layout>
