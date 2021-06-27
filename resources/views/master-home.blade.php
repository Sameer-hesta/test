@extends('layouts.master-app')

@section('content')
<meta name="user-id" content="{{ Auth::user()->id }}">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary export-button" href="{{ URL::to('call/pdf') }}">Export to PDF </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($users)>0)
                        <!-- <select class="form-select" name="user" >
                            <option selected>Open this select menu</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">Floor No. {{$user->f_no}}</option>
                            @endforeach
                        </select> -->

                            <div class="row">
                                <div class="col-md-1"><h4>S.No</h4></div>
                                <div class="col-md-2"><h4>Floor No.</h4></div>
                                <div class="col-md-3"><h4>Call From</h4></div>
                                <div class="col-md-2"><h4>Call Time</h4></div>
                                <div class="col-md-2"><h4>Call Received</h4></div>
                                <div class="col-md-2"><h4>Call Status</h4></div>
                            </div>
                            @foreach($calls as $index => $call)
                                <?php
                                   $msg = $call->r_type.' '.'=>'.' '.($call->r_no?$call->r_no:'').(($call->r_no?'':' ').$call->b_no?$call->b_no.' ':'').($call->b_type?$call->b_type:'');
                                ?>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-1">{{$calls->perPage() * ($calls->currentPage() - 1)+$index+1}}</div>
                                    <div class="col-md-2">{{$call->f_no}}</div>
                                    <div class="col-md-3">{{$msg}}</div>
                                    <div class="col-md-2">{{$call->created_at}}</div>
                                    <div class="col-md-2">{{$call->status?$call->updated_at:'--'}}</div>
                                    <div class="col-md-2">{{$call->status?"Received":"Pending"}}</div>
                                </div>
                            @endforeach
                            {{$calls->links()}}
                        </div>
                    @else
                        <h3>No floor station is available.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
