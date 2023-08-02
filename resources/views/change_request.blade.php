<x-app-layout>
    <change-request     :current-user-id="{{ auth()->user()->id }}" :key="new Date().getTime()" :change-requests="{{ json_encode($changeRequests) }}"></change-request>
</x-app-layout>
