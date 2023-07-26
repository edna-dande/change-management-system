@extends('layouts.app')

@section('content')
    @if(Auth::user()->permissions()->contains('create_project'))
        <h1 style="font-size: 25px;">List of Users</h1>
        <p>Manage your Users with ease</p>

        <a class="btn btn-primary" href="{{ route('users.create') }}">Create User</a>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->location }}</td>
                    <td>
{{--                        @if(Auth::user()->permissions()->contains('view_project'))--}}
                            <a class="btn btn-sm btn-info" style='margin-right: 5px;' href="{{ route('users.show', $user->id) }}">View</a>
{{--                        @endif--}}
{{--                        @if(Auth::user()->permissions()->contains('edit_project'))--}}
                            <a class="btn btn-sm btn-primary" style='margin-right: 5px;' href="{{ route('users.edit', $user->id) }}">Edit</a>
{{--                        @endif--}}
{{--                        @if(Auth::user()->permissions()->contains('delete_project'))--}}
                            <form action="{{ route('users.destroy', $user->id) }}" style="display: inline-block;" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" style='background-color:red; margin-right: 5px;' onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <p>Unauthorized</p>
    @endif
@endsection

