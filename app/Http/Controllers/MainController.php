<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mock;

class MainController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function howToUse()
    {
        return view('howToUse');
    }

    public function mocks()
    {
        return view('mocks');
    }

    public function watch($endpoint)
    {
        $mock = Mock::withTrashed()->where('endpoint', $endpoint)->first();
        return view('watch', compact('mock'));
    }
}
