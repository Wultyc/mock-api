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
