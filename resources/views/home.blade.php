@extends('layouts.app')
<link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
@section('content')
<meta name="user-id" content="{{ Auth::user()->id }}">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-white bg-dark mb-3">
                <!-- <div class="card-header"></div> -->
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                    <audio id="myAudio">
                        <source src="tracks/{{auth()->user()->audio}}" type="audio/mpeg" >
                        Your browser does not support the audio element.
                    </audio>
                        <example-component></example-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
