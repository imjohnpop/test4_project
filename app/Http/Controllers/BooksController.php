<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function list() {
        $view = view('Bookly/book');
        $books = Books::get();
        $view->books = $books;
        return $view;
    }

    public function store($id = null) {

        if($id) {
            $book = Books::findOrFail($id);
            if(isset($book)){
                $book->fill([
                    'title' => request()->input('title'),
                    'author_id' => request()->input('author_id'),
                    'published_at' => request()->input('published_at'),
                    'finished_reading_at' => request()->input('finished_reading_at'),
                    'my_review' => request()->input('my_review'),
                    'my_rating' => request()->input('my_rating')
                ]);
                $book->save();
            }
        } else {
            $book = new Books();
            $book->update([
                'title' => request()->input('title'),
                'author_id' => request()->input('author_id'),
                'published_at' => request()->input('published_at'),
                'finished_reading_at' => request()->input('finished_reading_at'),
                'my_review' => request()->input('my_review'),
                'my_rating' => request()->input('my_rating')
            ]);
            $book->save();
        }

        return redirect()->action('BooksController@list');
    }
}
