<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class Mock extends Model
{
    use SoftDeletes;

    protected $fillable = ['endpoint', 'query', 'payload'];

    const FULL_DELETED = "Full Deleted";
    const SOFT_DELETED = "Soft Deleted";

    /**
     * Create a new Endpoint
     *
     * @param String $endpoint
     * @param Request $request
     * @return array|boolean $mock 
     */
    public static function createEndpoint(String $endpoint, Request $request)
    {
        $mock = new Mock;

        $mock->endpoint = $endpoint;
        $mock->query = json_encode($request->query());
        $mock->payload = json_encode($request->post());

        try{
            $mock->save();              
        } catch(QueryException $e) {
            $mock = false;
        }

        return $mock; 
    }

    /**
     * Update all attributes of an Endpoint
     *
     * @param String $endpoint
     * @param Request $request
     * @return array|boolean $requestedMock 
     */
    public static function updateEndpoint(String $endpoint, Request $request)
    {
        $requestedMock = Mock::where('endpoint', $endpoint)->first();

        if(is_null($requestedMock))
            return false;

        $requestedMock->query = json_encode($request->query());
        $requestedMock->payload = json_encode($request->post());
        
        $requestedMock->save();

        return $requestedMock;
            
    }
    
    /**
     * Enable an Endpoint
     *
     * @param String $endpoint
     * @return boolean $mockedRequest 
     */
    public static function enableEndpoint(String $endpoint)
    {
        $requestedMock = Mock::withTrashed()->where('endpoint', $endpoint)->first();

        if(is_null($requestedMock))
            return false;

        $requestedMock->deleted_at = null;
        
        $requestedMock->save();

        return $requestedMock;
            
    }

    /**
     * Delete a single Endpoint
     *
     * @param String $endpoint
     * @param Request $request
     * @return string|boolean $deleteType 
     */
    public static function deleteEndpoint(String $endpoint, Request $request)
    {
        $deleteType = null;
        $requestQuery = $request->query();
        $requestedMock = Mock::withTrashed()->where('endpoint', $endpoint)->first();

        if(is_null($requestedMock))
            return false;
        
        if(array_key_exists('MockAPiForceDelete', $requestQuery) && $requestQuery['MockAPiForceDelete'] == 'true'){
            $requestedMock->forceDelete();
            $deleteType = Mock::FULL_DELETED;
        } else {
            $requestedMock->delete();
            $deleteType = Mock::SOFT_DELETED;
        }

        return $deleteType;
    }

    /**
     * Stores many endpoints at once
     *
     * @param Request $request
     * @return array $reportArray
     */
    public static function storeListEndpoits(Request $request)
    {
        $mocks = $request->post(); //Request payload
        $status = null;
        $reportArray = array();

        foreach ($mocks as $mock) {
            $mock_obj = new Mock;

            $mock_obj->endpoint = $mock['endpoint'];
            $mock_obj->query = $mock['query'];
            $mock_obj->payload = $mock['payload'];

            try {
                $status = 'ok';
                $mock_obj->save();
            } catch (QueryException $e) {
                $status = 'fail';
            }

            array_push($reportArray, array('endpoint' => $mock['endpoint'], 'status' => $status));
        }
        return $reportArray;
    }
}
