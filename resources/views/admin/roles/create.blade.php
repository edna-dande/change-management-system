<x-app-layout>

    {{--        @if(Auth::user()->permissions()->contains('create_user'))--}}
    <div class="dashboard">

    <h2>Create New Role</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" required>
        <br>
        {{--        <label for="password">Password:</label>--}}
        {{--        <input class="form-control" type="password" name="password" required>--}}
        {{--        <br>--}}
        <button type="submit" class="btn btn-primary">Create Role</button>
    </form>
    {{--        @else--}}
    {{--            <p>Unauthorized</p>--}}
    {{--        @endif--}}
    </div>

</x-app-layout>
