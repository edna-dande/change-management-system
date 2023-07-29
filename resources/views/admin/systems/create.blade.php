<x-app-layout>

    {{--        @if(Auth::user()->permissions()->contains('create_user'))--}}
    <h2>Create New System</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('systems.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" required>
        <br>
        <label for="description">Description:</label>
        <input class="form-control" type="description" name="description" required>
        <br>
        {{--        <label for="password">Password:</label>--}}
        {{--        <input class="form-control" type="password" name="password" required>--}}
        {{--        <br>--}}
        <button type="submit" style="background-color: blue;" class="btn btn-primary">Create System</button>
    </form>
    {{--        @else--}}
    {{--            <p>Unauthorized</p>--}}
    {{--        @endif--}}

</x-app-layout>
