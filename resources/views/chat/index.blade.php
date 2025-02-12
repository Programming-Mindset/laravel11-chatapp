@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Chat Room</div>
            <div class="card-body">
                <div id="messages" class="mb-3">
                    @foreach ($messages as $message)
                        <p><strong>{{ $message->user->name }}:</strong> {{ $message->message }} <span
                                style="font-size:10px">{{ $message->created_at->format('h:i:sa, d-m-Y') }}</span></p>
                    @endforeach
                </div>
                <form id="chat-form">
                    <div class="input-group">
                        <input type="text" id="message" class="form-control" placeholder="Type a message..." required>
                        <button type="button" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/socket.io-client@4.5.1/dist/socket.io.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        $(document).ready(function () {
            window.userId = "{{ auth()->id() }}";

            // jQuery version of form submit event
            $(document).on("click", '#chat-form button', function (e) {
                e.preventDefault(); // Prevent default form submission

                const message = $("#message").val(); // Get the value of the message input

                // Send message via fetch API
                $.ajax({
                    url: "{{ route('chat.send') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                    },
                    data: JSON.stringify({message: message}),
                    success: function (data) {
                        messagesDiv.append(`<p><strong>You:</strong> ${data.message.message}</p>`);
                        $("#message").val(""); // Clear the message input
                    }
                });
            });
        });
    </script>

@endpush
