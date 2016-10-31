@extends('layouts.request')

@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <h1 class="text-center title-header">UM QMO</h1>
        <div class="panel panel-default">
            <div class="panel-body">
                <form action=" {{ url('/request-form') }} " method="POST" class="form-horizontal" role="form">

                    <div class="form-group">
                        <legend>Request Form</legend>
                    </div>

                    <div> 
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>  

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control input-lg" id="" placeholder="May I know you..." name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control input-lg" id="" placeholder="Maybe we can email you..." name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Contact Number</label>
                        <input type="text" class="form-control input-lg" id="" placeholder="Please give the valid one so we can contact you..." name="contact_number" value="{{ old('contact_number') }}">
                    </div>

                    <div class="row"> 
                        <div class="col-sm-10" style="padding-right: 40px;"> 
                            <div class="form-group">
                                <label for="">College</label>
                                <input type="text" class="form-control input-lg" id="" placeholder="Be proud..." name="college" value="{{ old('college') }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="">School Year</label>
                                <input type="text" class="form-control input-lg" id="" placeholder="Batch year" name="school_year"
                                value="{{ old('school_year') }}">
                            </div>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="">Requesting For</label>
                        <textarea type="text" class="form-control input-lg"
                        rows="5" placeholder="What you want..." name="request_for">{{ old('request_for') }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

