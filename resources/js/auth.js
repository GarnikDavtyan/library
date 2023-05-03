import { request } from './requests.js';

$('#register-form').on('submit', function(event) {
    event.preventDefault();

    request('/api/register', 'POST', $(this));
});

$('#login-form').on('submit', function(e) {
    e.preventDefault();

    request('/api/login', 'POST', $(this));
});
