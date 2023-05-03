<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExcelRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Imports\BooksImport;
use App\Jobs\NotifyUserOfCompletedImport;
use App\Models\Book;
use App\Models\Comment;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BookService {
    public function list(Request $request): LengthAwarePaginator
    {
        $booksQuery = Book::query();

        $selectedCategory = $request->category_filter;
        
        if ($selectedCategory) {
            $booksQuery->whereHas('category', function (Builder $query) use ($selectedCategory) {
                $query->where('slug', $selectedCategory);
            });
        }
        
        $books = $booksQuery->with('category')->paginate(10)->appends(['category_filter' => $selectedCategory]);

        return $books;
    }

    public function show(Book $book)
    {
        $book->load('comments');

        return $book;
    }

    public function store(StoreBookRequest $request): Book
    {
        try {
            $data = $request->all();
            
            if ($request->hasFile('cover')) {
                $coverPath = Storage::putFile('covers', $request->file('cover'));
                $data['cover'] = 'storage/' . $coverPath;
            }

            $book = Book::create($data);

            return $book;
        } catch (Exception $e) {
            Storage::delete($coverPath);

            throw $e;
        } 
    }
    
    public function update(UpdateBookRequest $request, Book $book): Book
    {
        try {
            $data = $request->all();

            $oldCover = '';
            $coverPath = '';
            if($request->hasFile('cover')) {
                if($book->cover) {
                    $oldCover = Str::after($book->cover, 'storage');
                }

                $coverPath = Storage::putFile('covers', $request->file('cover'));
                
                $data['cover'] = 'storage/' . $coverPath;
            }

            $book->update($data);

            if ($oldCover) {
                Storage::delete($oldCover);
            }
            
            return $book;
        } catch (Exception $e) {
            Storage::delete($coverPath);

            throw $e;
        }
    }

    public function delete(Book $book): void
    {
        try {
            DB::beginTransaction();

            Comment::where('book_id', $book->id)->delete();
            $cover = Str::after($book->cover, 'storage');
            
            $book->delete();
            
            DB::commit();
            
            Storage::delete($cover);        
        } catch (Exception $e) {
            DB::rollBack();
            
            throw $e;
        }
    }

    public function comment(CommentRequest $request, Book $book): Comment
    {
        $comment = new Comment();

        $comment->user_id = Auth::id();
        $comment->book_id = $book->id;
        $comment->text = $request->comment;

        $comment->save();

        return $comment;
    }

    public function excel(ExcelRequest $request) 
    {
        $file = $request->file('excel');

        Excel::queueImport(new BooksImport(Auth::user()), $file)
            ->chain([new NotifyUserOfCompletedImport(Auth::user())]);
    }
}