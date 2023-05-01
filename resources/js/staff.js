import { request } from './requests.js';

$('#staff-create').on('submit', function(e) {
    e.preventDefault();

    request('/api/staff', 'POST', $(this), true);
});

$('#staff-edit').on('submit', function(e) {
    e.preventDefault();
    
    let id = $('#staff-id').val();

    request('/api/staff/' + id, 'PUT', $(this), true);
});

$('body').on('click', '#staff-delete', function(e) {
    e.preventDefault();
    let id = $(this).attr('attr-id');

    request('/api/staff/' + id, 'DELETE');
});
