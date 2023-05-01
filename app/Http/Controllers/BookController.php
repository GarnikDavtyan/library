<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;
    private $categories;

    public function __construct(BookService $bookService, CategoryService $categoryService)
    {
        $this->bookService = $bookService;
        $this->categories = $categoryService->list();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = $this->bookService->list($request);
        $categories = $this->categories;
        $selectedCategory = $request->category_filter;

        return view('pages.books.index', compact('books', 'categories', 'selectedCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categories;

        return view('pages.books.create', compact('categories') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = $this->bookService->show($book);

        return view('pages.books.view', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = $this->categories;

        return view('pages.books.edit', compact('book', 'categories'));
    }
}
