<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mock;

class MockResourceController extends Controller
{
    public function get($endpoint){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();
        echo $requestedMock->payload;
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
        $requestedMock = Mock::where('endpoint', $endpoint)->first();

        $requestedMock->query = json_encode($request->query());
        $requestedMock->payload = json_encode($request->post());
        
        if($requestedMock->isDirty())
            $requestedMock->save();
    }
    
    public function delete($endpoint){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();
        $requestedMock->delete();
    }
}
