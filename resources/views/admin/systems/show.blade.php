<x-app-layout>
    {{--    @if(Auth::user()->permissions()->contains('view_user'))--}}
    <div class="container dashboard">
        <h1>System Details</h1>
        <p>Name: {{ $system->name }}</p>
        <p>Description: {{ $system->description }}</p>
        {{--            @endif--}}

        {{--            @if(Auth::user()->permissions()->contains('edit_user'))--}}
        <a class="btn btn-primary-outline" href="{{ route('systems.edit', ['system' => $system->id]) }}"><font-awesome-icon :icon="['far', 'pen-to-square']" style="color: #3671d9;" /></a>
        {{--            @endif--}}
        {{--            @if(Auth::user()->permissions()->contains('delete_user'))--}}
        <form action="{{ route('systems.destroy', $system->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger-outline"><font-awesome-icon icon="fa-solid fa-trash" style="color: #c4290e;" /></button>
        </form>
    </div>
    {{--    @else--}}
    {{--        <p>Unauthorized</p>--}}
    {{--    @endif--}}
</x-app-layout>

