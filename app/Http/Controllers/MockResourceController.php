<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mock;

class MockResourceController extends Controller
{
    public function get($endpoint){

    }

    public function post($endpoint, Request $request){
        $mockedRequest = Mock::create([
            'endpoint' => $endpoint,
            'query' => json_encode($request-> query()),
            'payload' => json_encode($request-> post())
        ]);

        //$mockedRequest->save();
    }

    public function put($endpoint, Request $request){

    }
    
    public function delete($endpoint){

    }
}
