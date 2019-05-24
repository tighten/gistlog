<?php

namespace Gistlog\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function createForm()
    {
        return view('create');
    }
}
