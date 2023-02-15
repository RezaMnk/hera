import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
// import '../sass/app.scss'

window.Toastify = Toastify;

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    // forceTLS: true
});
