import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Make Pusher available globally
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher', // Set broadcaster to pusher
    key: import.meta.env.VITE_PUSHER_APP_KEY, // Use Vite environment variable for the app key
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // Use Vite environment variable for the cluster
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https', // Use https if set
});

