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
        $request = request();

        $this->validate($request, [
            'name' => 'required|min:2',
            'year_of_birth' => 'required|numeric|min:0|max:2100',
        ]);


        $author = new Authors();

        //insert data
        $author->fill([
            'name' => $request->input('name'),
            'year_of_birth' => $request->input('year_of_birth')
        ]);
        $author->save();

        return redirect()->action('AuthorsController@list');
    }

    public function edit($id = null) {
        $request = request();

        $this->validate($request, [
            'name' => 'required|min:2',
            'year_of_birth' => 'required|numeric|min:0|max:2100',
        ]);


        $author = Authors::findOrFail($id);
        $author->update([
            'name' => $request->input('name'),
            'year_of_birth' => $request->input('year_of_birth')
        ]);
        $author->save();

        return redirect()->action('AuthorsController@list');
    }

    public function destroy($id) {
        Authors::where('id', '=', $id)->delete();
        return redirect()->action('AuthorsController@list');
    }
}
