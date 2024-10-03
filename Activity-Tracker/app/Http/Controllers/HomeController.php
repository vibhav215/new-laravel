<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function gallery()
    {
        return view('gallery');
    }

    public function contact()
    {
        return view('Pages.contact');
    }

    public function license()
    {
        return view('Pages.license');
    }

    public function about()
    {
        return view('Pages.about');
    }
}