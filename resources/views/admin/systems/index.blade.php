<x-app-layout>
    <div class="dashboard">
        <h1>List of Systems</h1>
        <p>Manage your systems with ease</p>
        <a class="btn btn-primary" href="{{ url("/systems/create") }}">
                <span>
                    <font-awesome-icon icon="fa-solid fa-plus" style="color: #ffffff;"/>
                </span>
            <span class="create-text"> Create </span>
        </a>

        <table class="table">
            <thead>
            <tr>
                <th >Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($systems as $system)
                <tr>
                    <td>{{ $system->name }}</td>
                    <td>{{ $system->description }}</td>

                    <td class="text-center">
                        <a class="btn" href="{{ url("/systems/show/{$system->id}") }}">
                            <font-awesome-icon icon="fa-solid fa-eye" />
                        </a>
                                                <a class="btn" href="{{ route('systems.edit', ['system' => $system->id]) }}">
                                                    <font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" />
                                                </a>
                        <form action="{{ url("/systems/{$system->id}") }}" style="display: inline-block;" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit" onclick="return confirm('Are you sure?')">
                                <font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" />
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No systems</td></tr>
            @endforelse


            </tbody>
        </table>
    </div>
</x-app-layout>
