<x-app-layout>
    <div class="dashboard">
        <h1>List of Roles</h1>
        <p>Manage your roles with ease</p>
        <a class="btn btn-primary" href="{{ url("/roles/create") }}">
                <span>
                    <font-awesome-icon icon="fa-solid fa-plus" style="color: #ffffff;"/>
                </span>
            <span class="create-text"> Create </span>
        </a>

        <table class="table">
            <thead>
            <tr>
                <th >Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>

                    <td class="text-center">
                        <a class="btn" href="{{ url("/roles/show/{$role->id}") }}">
                            <font-awesome-icon icon="fa-solid fa-eye" />
                        </a>
                                                <a class="btn" href="{{ route('roles.edit', ['role' => $role->id]) }}">
                                                    <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
                                                </a>
                        <form action="{{ url("/roles/{$role->id}") }}" style="display: inline-block;" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit" onclick="return confirm('Are you sure?')">
                                <font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" />
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2">No Roles</td></tr>
            @endforelse


            </tbody>
        </table>
    </div>
</x-app-layout>
