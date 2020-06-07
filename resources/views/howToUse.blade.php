@extends('layout.main')

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">How To Use</h1>
    <p class="lead">This mocking service has a very simple aproach. You only need to make a POST request for the endpoint you want and then make a GET request on the same endpoint to receive the same payload sent on POST.</p>
</div>
<div align="justify" class="container">
    <div class="row mt-3">
        <h1 class="mt-5">Simple Guide</h1>
        <p class="lead">Your endpoint can be anything inside <code>http://&#60;Mocking Service Host&#62;/api</code>, for example, <code>http://example.com/api/tstEndpoint</code>.</p>
    </div>
    <div class="row mt-3">
        <h2>Available HTTP verbs</h2>
    </div>

    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-success btn-sm">GET</button>
        </div>
        <div class="col-md-11">
            Returns mocked response.
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-warning btn-sm">POST</button>
        </div>
        <div class="col-md-11">
            Create a mock endpoint. Query string and payload are saved.
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-primary btn-sm">PUT</button>
        </div>
        <div class="col-md-11">
            Update query string and payload of mock endpoint.
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-secondary btn-sm">PATCH</button>
        </div>
        <div class="col-md-11">
            Enable an endpoint.
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-danger btn-sm">DELETE</button>
        </div>
        <div class="col-md-11">
            Disable an endpoint. If you want to completely remove the endpoint send the Delete request with <code>MockAPiForceDelete = true</code> query parameter.
        </div>
    </div>
    <div class="row mt-3">
        <h2>Management Servive</h2>
        <p>If you need to list all your endpoint or create multiples at once, you can use this service. <strong>Endpoint:</strong> <code>/api/mgmt</code></p>
    </div>
    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-success btn-sm">GET</button>
        </div>
        <div class="col-md-11">
            Print all available endpoints with the respective query strings and payloads.<br>
            To get all details from a single endpoint, send a request following the structure <code>/api/mgmt/{endpoint}</code>.<br>
            <strong>Example:</strong> <code>/api/mgmt/tstEndpoint</code></p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-1">
            <button type="button" class="btn btn-outline-warning btn-sm">POST</button>
        </div>
        <div class="col-md-11">
            Create many endpoints at once.
        </div>
    </div>
</div>

@endsection