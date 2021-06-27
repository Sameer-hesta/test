<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            width:100%;
        }

        .table{
            text-align:center;
            margin:auto;
            border-collapse: collapse; 
        }        
        tr.border_bottom td {
            border-bottom: 1px solid black;
            padding:10px;   
            width: auto !important;
        }
    </style>
</head>
  <body>
    <table class="table">
    <thead>
      <tr class="border_bottom">
        <td><h4>S No</h4></td>
        <td><h4>F No.</h4></td>
        <td><h4>Call From</h4></td>
        <td><h4>Call Time</h4></td>
        <td><h4>Call Received</h4></td>
        <td><h4>Call-Status</h4></td>
      </tr>
      </thead>
      <tbody>
        @foreach ($calls as $index => $call)
        <?php
            $msg = $call->r_type.' '.'=>'.' '.($call->r_no?$call->r_no:'').(($call->r_no?'':' ').$call->b_no?$call->b_no.' ':'').($call->b_type?$call->b_type:'');
        ?>
        <tr class="border_bottom">
            <td>{{$index+1}}</td>
            <td>{{$call->f_no}}</td>
            <td>{{$msg}}</td>
            <td>{{$call->created_at}}</td>
            <td>{{$call->status?$call->updated_at:'--'}}</td>
            <td>{{$call->status?"Received":"Pending"}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>