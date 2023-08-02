<x-app-layout>
    <user-details :user="{{ json_encode($user) }}" :authid="{{ auth()->id() }}"></user-details>
</x-app-layout>
