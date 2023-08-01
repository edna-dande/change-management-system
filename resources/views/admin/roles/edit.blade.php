<x-app-layout>

    {{--        @if(Auth::user()->permissions()->contains('edit_user'))--}}
    <div class="container dashboard">
        <h1>Edit Role</h1>
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
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input class="form-control" type="text" name="name" value="{{ $role->name }}" required>
            <br>
            <button type="submit" class="btn btn-primary">Update Role</button>
        </form>
    </div>
    {{--        @else--}}
    {{--            <p>Unauthorized</p>--}}
    {{--        @endif--}}
</x-app-layout>
