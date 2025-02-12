<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" data-user-id="{{ auth()->id() }}">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ @$slot }}
            </main>
        </div>
    </body>


<script src="https://cdn.jsdelivr.net/npm/socket.io-client@4.5.1/dist/socket.io.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        window.userId = "{{ auth()->id() }}";

        $(document).on("click", '#chat-form button', function (e) {
            e.preventDefault(); // Prevent default form submission

            const messagesDiv = $("#messageDiv"); // Get the value of the message input
            const message = $("#messageInput").val(); // Get the value of the message input

            // Send message via fetch API
            $.ajax({
                url: "{{ route('chat.send') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Content-Type": "application/json",
                },
                data: JSON.stringify({message: message}),
                success: function (data) {
                   // messagesDiv.append(`<p><strong>You:</strong> ${data.message.message}</p>`);
                    messagesDiv.append(`
                    <p class="text-sm">
                        <strong class="text-blue-600">You:</strong> ${data.message.message}
                        <span class="text-xs text-gray-500 ml-2">10:22:06am, 12-02-2025</span>
                    </p>
                    `);
                    $("#messageInput").val(""); // Clear the message input
                }
            });
        });
    });
</script>


</html>
