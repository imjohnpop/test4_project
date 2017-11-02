<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $view = view('Bookly/home');
        return $view;
    }
}
