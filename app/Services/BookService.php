<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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

            $coverPath = Storage::putFile('covers', $request->file('cover'));

            $slug = Str::slug($request->title);

            // generate a unique slug
            while(Book::where('slug', $slug)->first()) {
                $slug .= '-'. strtolower(Str::random(3));
            }

            $data['slug'] = $slug;
            $data['cover'] = 'storage/' . $coverPath;

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
            if ($request->hasFile('cover')) {
                $oldCover = Str::after($book->cover, 'storage');

                $coverPath = Storage::putFile('covers', $request->file('cover'));
                
                $data['cover'] = 'storage/' . $coverPath;
            }

            $slug = Str::slug($request->title);
            
            // generate a unique slug
            while(Book::where('id', '<>', $book->id)->where('slug', $slug)->first()) {
                $slug .= '-'. strtolower(Str::random(3));
            }
            $data['slug'] = $slug;

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
}