@extends('layout.main')

@section('content')
<div align="justify" class="container">
    <div class="row mt-3">
        <h2>Available endpoints</h2>
    </div>

    <div class="loader" id="loader"></div>

    <div class="details" id="api_details">
        <form class="needs-validation" novalidate="" _lpchecked="1">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Endpoint</label>
                        <input type="text" class="form-control" id="endpoint" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Status</label>
                        <input type="text" class="form-control" id="status" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Created At</label>
                        <input type="text" class="form-control" id="created_at" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address">Updated At</label>
                        <input type="text" class="form-control" id="updated_at" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="address">Query String</label>
                        <input type="text" class="form-control" id="query_string" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="address">Message</label>
                        <textarea class="form-control" id="payload" disabled></textarea>
                    </div>
                </div>
            </div>
        </form>
        <button class="btn btn-sm btn-primary" onclick="location.href='{{route('mocks')}}';">Return</button>
    </div>
</div>

@endsection

@section('custom_css')
<style>
    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
        margin: auto;
        padding: 10px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .details {
        display: none;
    }
</style>
@endsection

@section('custom_js')
<script>
    let uri = document.location.pathname;
    uri = uri.replace("/Mocks/Watch/", "");
    uri = "/api/mgmt/" + uri;

    const fetchPromise = fetch(uri);
    fetchPromise.then(response => {
        return response.json();
    }).then(api_list => {
        show_api_list(api_list.data);
    });

    function show_api_list(apilist) {

        document.getElementById("loader").remove();
        document.getElementById("api_details").style.display = "block";

        let endpoint = document.getElementById("endpoint");
        let status = document.getElementById("status");
        let created_at = document.getElementById("created_at");
        let updated_at = document.getElementById("updated_at");
        let query_string = document.getElementById("query_string");
        let payload = document.getElementById("payload");

        endpoint.value = apilist.endpoint;
        status.value = (apilist.enabled == true) ? "Enabled" : "Disabled";
        created_at.value = apilist.created_at;
        updated_at.value = apilist.updated_at;
        query_string.value = apilist.query;
        payload.value = apilist.payload;
    }
</script>
@endsection