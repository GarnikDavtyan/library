<?php

namespace App\Models;

use App\Models\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'author',
        'description',
        'cover'
    ];

    //added for BookImport
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $slug = Str::slug($value);

        //generate unique slug
        while($this->where('slug', $slug)->exists()) {
            $slug .= '-'. strtolower(Str::random(3));
        }

        $this->attributes['slug'] = $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            $slug = Str::slug($book->title);

            //generate unique slug
            while(Book::where('slug', $slug)->exists()) {
                $slug .= '-'. strtolower(Str::random(3));
            }

            $book->slug = $slug;
        });

        static::updating(function ($book) {
            $slug = Str::slug($book->title);

            //generate unique slug
            while(Book::where('id', '<>', $book->id)->where('slug', $slug)->exists()) {
                $slug .= '-'. strtolower(Str::random(3));
            }

            $book->slug = $slug;
        });
    }

    protected static function booted()
    {
        static::addGlobalScope(new LatestScope);
    }
}
