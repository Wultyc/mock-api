@extends('layout.main')

@section('content')
<div align="justify" class="container">
    <div class="row mt-3">
        <h2>Available endpoints</h2>
    </div>

    <div id="api_details">
        <form class="needs-validation" novalidate="" _lpchecked="1">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Endpoint</label>
                        <input type="text" class="form-control" id="endpoint" disabled value="{{$mock->endpoint}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Status</label>
                        <input type="text" class="form-control" id="status" disabled value="{{($mock->deleted_at == null) ? 'Inactive' : 'Active'}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Created At</label>
                        <input type="text" class="form-control" id="created_at" disabled value="{{$mock->created_at}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Updated At</label>
                        <input type="text" class="form-control" id="updated_at" disabled value="{{$mock->updated_at}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="address">Query String</label>
                        <input type="text" class="form-control" id="query_string" disabled value="{{$mock->query}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="address">Message</label>
                        <textarea class="form-control" id="payload" disabled>{{$mock->payload}}</textarea>
                    </div>
                </div>
            </div>
        </form>
        <button class="btn btn-sm btn-primary" onclick="location.href='{{route('mocks')}}';">Return</button>
    </div>
</div>

@endsection