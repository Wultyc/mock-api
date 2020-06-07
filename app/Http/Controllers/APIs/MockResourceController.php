<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Models\Mock;
use App\Http\Resources\MockResource;

class MockResourceController extends Controller
{
    public function get($endpoint){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();
        return (!is_null($requestedMock)) ? new MockResource($requestedMock) : abort(404);
    }

    public function post($endpoint, Request $request){
        $mockedRequest = new Mock;

        $mockedRequest->endpoint = $endpoint;
        $mockedRequest->query = json_encode($request->query());
        $mockedRequest->payload = json_encode($request->post());
        

        try{
            if($mockedRequest->save())
                return new MockResource($mockedRequest);
        } catch(QueryException $e) {
            abort(403);
        }
        
    }

    public function put($endpoint, Request $request){
        $requestedMock = Mock::where('endpoint', $endpoint)->first();

        if(is_null($requestedMock))
            return abort(404);

        $requestedMock->query = json_encode($request->query());
        $requestedMock->payload = json_encode($request->post());
        
        if($requestedMock->save())
            return new MockResource($requestedMock);
    }

    public function patch($endpoint){
        $requestedMock = Mock::withTrashed()->where('endpoint', $endpoint)->first();

        if(is_null($requestedMock))
            return abort(404);

        $requestedMock->deleted_at = null;
        
        if($requestedMock->save())
            return new MockResource($requestedMock);
    }
    
    public function delete($endpoint, Request $request){
        $requestQuery = $request->query();
        $requestedMock = Mock::withTrashed()->where('endpoint', $endpoint)->first();

        if(is_null($requestedMock))
            return abort(404);
        
        if(array_key_exists('MockAPiForceDelete', $requestQuery) && $requestQuery['MockAPiForceDelete'] == 'true'){
            $requestedMock->forceDelete();
        } else {
            $requestedMock->delete();
        }
    }
}
