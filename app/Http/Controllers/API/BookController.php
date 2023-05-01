<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $service)
    {
        $this->bookService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = $this->bookService->list($request);

        return $this->successResponse($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        try {
            $book = $this->bookService->store($request);

            return $this->successResponse($book, 'Book created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = $this->bookService->show($book);

        return $this->successResponse($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $book = $this->bookService->update($request, $book);
            
            return $this->successResponse($book, 'Book updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $this->bookService->delete($book);
            
            return $this->successResponse(null, 'Book deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function comment(CommentRequest $request, Book $book)
    {
        try {
            $comment = $this->bookService->comment($request, $book);
            
            return $this->successResponse($comment, 'Comment added successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse();
        }
        

        
    }
}
