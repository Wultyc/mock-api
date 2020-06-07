@extends('layout.main')

@section('content')
<div align="justify" class="container">
    <div class="row mt-3">
        <h2>Available endpoints</h2>
    </div>

    <div id="app">
        <mock-list-page></mock-list-page>
    </div>
</div>

@endsection