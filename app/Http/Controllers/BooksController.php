<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    public function list() {
        $id = Auth::user()->id;
        $view = view('Bookly/book');
        $books = Books::where('user_id', '=', $id)->get();
        $view->books = $books;
        return $view;
    }

    public function store() {
        $request = request();

        $this->validate($request, [
            'title' => 'required|min:1',
            'author_id' => 'required',
            'published_at' => 'required|numeric|min:1900|max:2100',
            'finished_reading_at' => 'numeric|min:1900|max:2100',
            'my_review' => 'required|min:20',
            'my_rating' => 'required',
        ]);


        $id = Auth::user()->id;
        
        $book = new Books();
        $book->fill([
            'title' => $request->input('title'),
            'user_id' => $id,
            'author_id' => $request->input('author_id'),
            'published_at' => $request->input('published_at'),
            'finished_reading_at' => $request->input('finished_reading_at'),
            'my_review' => $request->input('my_review'),
            'my_rating' => $request->input('my_rating')
        ]);
        $book->save();

        return redirect()->action('BooksController@list');
    }

    public function edit($id = null) {
        $request = request();

        $this->validate($request, [
            'title' => 'required|min:1',
            'author_id' => 'required',
            'published_at' => 'required|numeric|min:1900|max:2100',
            'finished_reading_at' => 'numeric|min:1900|max:2100',
            'my_review' => 'required|min:20',
            'my_rating' => 'required',
        ]);


        $book = Books::findOrFail($id);
        $book->update([
            'title' => $request->input('title'),
            'author_id' => $request->input('author_id'),
            'published_at' => $request->input('published_at'),
            'finished_reading_at' => $request->input('finished_reading_at'),
            'my_review' => $request->input('my_review'),
            'my_rating' => $request->input('my_rating')
        ]);
        $book->save();

        return redirect()->action('BooksController@list');
    }

    public function destroy($id) {
        Books::where('id', '=', $id)->delete();
        return redirect()->action('BooksController@list');
    }
}
