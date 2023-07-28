<x-app-layout>

{{--        @if(Auth::user()->permissions()->contains('create_user'))--}}
            <h2>Create New User</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <label for="name">Name:</label>
                <input class="form-control" type="text" name="name" required>
                <br>
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" required>
                <br>
                <label for="role">Role:</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="">Select a role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <br>
                {{--        <label for="password">Password:</label>--}}
                {{--        <input class="form-control" type="password" name="password" required>--}}
                {{--        <br>--}}
                <button type="submit" style="background-color: blue;" class="btn btn-primary">Create User</button>
            </form>
{{--        @else--}}
{{--            <p>Unauthorized</p>--}}
{{--        @endif--}}

</x-app-layout>
