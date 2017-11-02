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

    public function store() {

        $book = new Books();
        $book->fill([
            'title' => request()->input('title'),
            'author_id' => request()->input('author_id'),
            'published_at' => request()->input('published_at'),
            'finished_reading_at' => request()->input('finished_reading_at'),
            'my_review' => request()->input('my_review'),
            'my_rating' => request()->input('my_rating')
        ]);
        $book->save();

        return redirect()->action('BooksController@list');
    }

    public function edit($id = null) {

        $book = Books::findOrFail($id);
        $book->update([
            'title' => request()->input('title'),
            'author_id' => request()->input('author_id'),
            'published_at' => request()->input('published_at'),
            'finished_reading_at' => request()->input('finished_reading_at'),
            'my_review' => request()->input('my_review'),
            'my_rating' => request()->input('my_rating')
        ]);
        $book->save();

        return redirect()->action('BooksController@list');
    }

    public function destroy($id) {
        Books::where('id', '=', $id)->delete();
        return redirect()->action('BooksController@list');
    }
}
