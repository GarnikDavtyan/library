import { request } from './requests.js';

$('#categories-create').on('submit', function(e) {
    e.preventDefault();

    request('/api/categories', 'POST', $(this), true);
});

$('#categories-edit').on('submit', function(e) {
    e.preventDefault();
    
    let id = $('#category-id').val();

    request('/api/categories/' + id, 'PUT', $(this), true);
});

$('body').on('click', '#categories-delete', function(e) {
    e.preventDefault();
    let id = $(this).attr('attr-id');

    request('/api/categories/' + id, 'DELETE');
});
