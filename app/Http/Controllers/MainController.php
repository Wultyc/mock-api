<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mock;

class MainController extends Controller
{
    public function watch($endpoint)
    {
        $mock = Mock::withTrashed()->where('endpoint', $endpoint)->first();
        return view('watch', compact('mock'));
    }
}
