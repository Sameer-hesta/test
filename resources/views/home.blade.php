@extends('layouts.app')

@section('content')
<meta name="user-id" content="{{ Auth::user()->id }}">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>{{ Auth::user()->name }}</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <example-component></example-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
