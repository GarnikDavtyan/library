import { request } from './requests.js';

$('#register-form').on('submit', function(event) {
    event.preventDefault();

    request('/api/register', 'POST', $(this));
});

$('#login-form').on('submit', function(e) {
    e.preventDefault();

    request('/api/login', 'POST', $(this));
});

$('#logout').on('click', function(e) {
    request('/api/logout', 'POST');
});