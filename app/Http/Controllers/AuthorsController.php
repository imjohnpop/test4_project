<?php

namespace App\Http\Controllers;

use App\Authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function list()
    {
        $view = view('Bookly/author');
        $authors = Authors::get();
        $view->authors = $authors;
        return $view;
    }

    public function store() {

        $author = new Authors();

        //insert data
        $author->fill([
            'name' => request()->input('name'),
            'year_of_birth' => request()->input('year_of_birth')
        ]);
        $author->save();

        return redirect()->action('AuthorsController@list');
    }
}
