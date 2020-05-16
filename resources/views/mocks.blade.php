@extends('layout.main')

@section('content')
<div align="justify" class="container">
    <div class="row mt-3">
        <h2>Available endpoints</h2>
    </div>

    <div class="loader" id="loader"></div>

    <div id="apis_list">
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
</style>
@endsection

@section('custom_js')
<script>
    const fetchPromise = fetch("/api/mgmt/");
    fetchPromise.then(response => {
        return response.json();
    }).then(api_list => {
        show_api_list(api_list);
    });

    function show_api_list(apilist) {
        document.getElementById("loader").remove();
        document.getElementById("apis_list").style.display = "";
        apilist.forEach(function(element) {
            let apis_list = document.getElementById("apis_list");

            let row = document.createElement("div");
            row.classList.add("row", "mt-3")

            let btn_col = document.createElement("div");
            btn_col.classList.add("col-md-1")

            let btn = document.createElement("button");
            btn.classList.add("btn", "btn-sm")

            let endpoint_col = document.createElement("div");
            endpoint_col.classList.add("col-md-11")

            let endpoint_link = document.createElement("a");
            endpoint_link.setAttribute('href', '/api/'+element.endpoint);
            endpoint_link.setAttribute('target', '_blank');
            endpoint_link.innerHTML = element.endpoint;

            if (element.deleted_at == null) {
                btn.classList.add("btn-outline-success");
                btn.innerHTML = "Available";
            } else {
                btn.classList.add("btn-outline-secondary");
                btn.innerHTML = "Disabled";
            }

            btn_col.appendChild(btn);
            endpoint_col.appendChild(endpoint_link);

            row.appendChild(btn_col);
            row.appendChild(endpoint_col);
            apis_list.appendChild(row);
        });
    }
</script>
@endsection