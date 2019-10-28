@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <the-dashboard></the-dashboard>

</div>
@endsection
