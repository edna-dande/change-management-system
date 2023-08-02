<x-app-layout>
    <admin-dashboard :users="{{ json_encode($users) }}" :authid="{{ auth()->id() }}"></admin-dashboard>
</x-app-layout>
