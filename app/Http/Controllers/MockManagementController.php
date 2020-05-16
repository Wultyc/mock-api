<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mock;
use App\Http\Resources\MockManagement;

class MockManagementController extends Controller
{
    public function list(Request $request)
    {
        $mocks = Mock::withTrashed()->get();
        return MockManagement::collection($mocks);
    }
}
