<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome to chat, You're logged in!!") }}
                </div>
            </div>
        </div>

    </div>


    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-4">
        <!-- Messages Container -->
        <div id="messageDiv" class="mb-4 space-y-2 max-h-60 overflow-y-auto p-2 border rounded">
            @foreach ($messages as $message)

            <p class="text-sm">
                <strong class="{{ auth()->id() == $message->user_id ? 'text-blue-600': 'text-green-600' }}">{{ $message->user->name }}:</strong> {{ $message->message }}
                <span class="text-xs text-gray-500 ml-2">{{ $message->created_at->format('h:i:sa, d-m-Y') }}</span>
            </p>
            @endforeach

        </div>

        <!-- Chat Form -->
        <form id="chat-form" class="flex items-center space-x-2">
            <input type="text" id="messageInput"
                   class="flex-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Type a message..." required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Send
            </button>
        </form>
    </div>

</x-app-layout>
