<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mock;
use App\Http\Resources\MockResource;

class MockResourceController extends Controller
{
    public function get($endpoint){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();
        return new MockResource($requestedMock);
    }

    public function post($endpoint, Request $request){
        $mockedRequest = new Mock;

        $mockedRequest->endpoint = $endpoint;
        $mockedRequest->query = json_encode($request-> query());
        $mockedRequest->payload = json_encode($request-> post());
        

        if($mockedRequest->save())
            return new MockResource($mockedRequest);
    }

    public function put($endpoint, Request $request){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();

        $requestedMock->query = json_encode($request->query());
        $requestedMock->payload = json_encode($request->post());
        
        if($requestedMock->save())
            return new MockResource($requestedMock);
    }

    public function patch($endpoint){
        $requestedMock = Mock::withTrashed()->where('endpoint', $endpoint)->first();

        $requestedMock->deleted_at = null;
        
        if($requestedMock->save())
            return new MockResource($requestedMock);
    }
    
    public function delete($endpoint){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();
        $requestedMock->delete();
    }
}
