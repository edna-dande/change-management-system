<x-app-layout>
    <div class="dashboard">
        <h1>List of Users</h1>
        <p>Manage your users with ease</p>
        <a class="btn btn-primary" href="{{ url("/users") }}">
                <span>
                    <font-awesome-icon icon="fa-solid fa-plus" style="color: #ffffff;"/>
                </span>
            <span class="create-text"> Create </span>
        </a>

        <table class="table">
            <thead>
            <tr>
                <th >Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge text-bg-dark">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a class="btn" href="{{ url("/users/show/{$user->id}") }}">
                            <font-awesome-icon icon="fa-solid fa-eye" />
                        </a>
{{--                        <a class="btn" href="{{ route('admin.users.edit', ['user' => $user->id]) }}">--}}
{{--                            <font-awesome-icon icon="fa-solid fa-pen-to-square" />--}}
{{--                        </a>--}}
                        <form action="{{ url("/users/{$user->id}") }}" style="display: inline-block;" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit" onclick="return confirm('Are you sure?')">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No users</td></tr>
            @endforelse


            </tbody>
        </table>
    </div>
</x-app-layout>
