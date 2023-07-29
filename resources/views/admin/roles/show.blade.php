<x-app-layout>
    {{--    @if(Auth::user()->permissions()->contains('view_user'))--}}
    <div class="container">
        <h2>Role Details</h2>
        <p>Name: {{ $role->name }}</p>
        {{--            @endif--}}

        {{--            @if(Auth::user()->permissions()->contains('edit_user'))--}}
        <a class="btn btn-primary-outline" href="{{ route('roles.edit', ['role' => $role->id]) }}"><font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" /></a>
        {{--            @endif--}}
        {{--            @if(Auth::user()->permissions()->contains('delete_user'))--}}
        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger-outline"><font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" /></button>
        </form>
    </div>
    {{--    @else--}}
    {{--        <p>Unauthorized</p>--}}
    {{--    @endif--}}
</x-app-layout>

