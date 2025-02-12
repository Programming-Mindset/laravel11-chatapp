import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const userId = document.body.getAttribute('data-user-id');

// Listen for incoming messages via Echo
window.Echo.channel("chat-channel")
    .listen(".message.sent", function (event) {
        const messagesDiv = $("#messageDiv");
        if (event.message.user_id !== userId) {
            const colorClass = event.message.user_id !== userId ? 'text-green-600' : 'text-blue-600';
            messagesDiv.append(`<p><strong class="${colorClass}">${event.message.user.name}:</strong> ${event.message.message} <span style="font-size:10px">${formatDate(event.message.created_at)}</span></p>`);
        }
    });

function formatDate(isoDate) {
    // Convert the ISO string to a Date object
    const date = new Date(isoDate);

    // Get hours, minutes, seconds, and determine AM/PM
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();
    let ampm = hours >= 12 ? 'pm' : 'am';

    // Convert hours to 12-hour format
    hours = hours % 12;
    hours = hours ? hours : 12; // 0 becomes 12

    // Add leading zero to minutes and seconds if needed
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    // Format the time (hh:mm:ss a)
    const time = `${hours}:${minutes}:${seconds}${ampm}`;

    // Get the date in MM-dd-yy format
    const day = date.getDate();
    const month = date.getMonth() + 1; // Months are 0-indexed
    const year = date.getFullYear().toString().slice(-2); // Get last two digits of the year

    // Format the date (MM-dd-yy)
    const formattedDate = `${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}-${year}`;

    return `${time}, ${formattedDate}`;
}

