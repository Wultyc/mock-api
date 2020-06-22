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
        $mockedRequest = Mock::createEndpoint($endpoint, $request);

        if($mockedRequest){
            return new MockResource($mockedRequest);
        } else {
            abort(403);
        }
      
    }

    public function put($endpoint, Request $request){
        $mockedRequest = Mock::updateEndpoint($endpoint, $request);

        if($mockedRequest){
            return new MockResource($mockedRequest);
        } else {
            abort(404);
        }
    }

    public function patch($endpoint){
        $mockedRequest = Mock::enableEndpoint($endpoint);

        if($mockedRequest){
            return new MockResource($mockedRequest);
        } else {
            abort(404);
        }
    }
    
    public function delete($endpoint, Request $request){
        $result = Mock::deleteEndpoint($endpoint, $request);
        if ($result != Mock::SOFT_DELETED && $result != Mock::FULL_DELETED) abort(404);
        return $result;
    }
}
