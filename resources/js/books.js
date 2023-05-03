import { request } from './requests.js';

$('#books-create').on('submit', function(e) {
    e.preventDefault();

    request('/api/books', 'POST', $(this), true, true);
});

$('#books-edit').on('submit', function(e) {
    e.preventDefault();

    let id = $('#book-id').val();

    request('/api/books/' + id, 'POST', $(this), true, true, true);
});

$('body').on('click', '#books-delete', function(e) {
    e.preventDefault();
    let id = $(this).attr('attr-id');

    request('/api/books/' + id, 'DELETE');
});

$('#comment').on('submit', function(e) {
    e.preventDefault();

    let id = $('#book-comment-id').val();

    request('/api/books/' + id + '/comment', 'POST', $(this));
});

$('#books-excel').on('submit', function(e) {
    e.preventDefault();

    request('/api/books/excel', 'POST', $(this), true, true);
});