@extends('layouts.request')

@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <h1 class="text-center title-header">UM QMO</h1>
        <div class="panel panel-default">
            <div class="panel-body">
                <center>
                    <img src="https://cdn1.iconfinder.com/data/icons/flat-rounded-long-shadow-icons/493/like.png" class="img-responsive" alt="Image" width="100px">
                </center>
                <h1 class="text-center text-success">
                    Request Submitted Successfully!!
                </h1>
            </div>
            <div class="panel-footer">
                <a href=" {{url('request-form')}} ">Submit another request.</a>
            </div>
        </div>
    </div>
</div>
@endsection