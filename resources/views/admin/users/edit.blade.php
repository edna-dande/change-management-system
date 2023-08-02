<x-app-layout>

{{--        @if(Auth::user()->permissions()->contains('edit_user'))--}}
            <div class="container dashboard">
                <h1>Edit User</h1>
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
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="name">Name:</label>
                        <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
                        <br>
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                        <br>
                        <label for="role">Role:</label>
                        <select name="role_ids[]" id="role_ids" class="form-control" multiple required>
                            <option value="">Select a role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
            </div>
{{--        @else--}}
{{--            <p>Unauthorized</p>--}}
{{--        @endif--}}
</x-app-layout>
