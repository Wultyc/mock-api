<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Models\Mock;
use App\Http\Resources\MockManagementList;
use App\Http\Resources\MockManagementInsert;

class MockManagementController extends Controller
{
    public function list(Request $request)
    {
        $mocks = Mock::withTrashed()->get();
        return MockManagementList::collection($mocks);
    }

    public function insert(Request $request)
    {
        $mocks = $request->post();
        $status = null;
        $reportArray = array();

        foreach($mocks as $mock){
            $mock_obj = new Mock;

            $mock_obj->endpoint = $mock['endpoint'];
            $mock_obj->query = $mock['query'];
            $mock_obj->payload = $mock['payload'];

            try{
                $status = 'ok';
                $mock_obj->save();
            } catch(QueryException $e) {
                $status = 'fail';
            }

            array_push($reportArray, array('endpoint'=>$mock['endpoint'], 'status'=>$status));
        }
        return MockManagementInsert::collection($reportArray);
    }
}
