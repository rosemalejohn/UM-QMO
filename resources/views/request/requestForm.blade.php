@extends('layouts.request')

@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-4">
                        <img src="/img/um.jpg" class="img-responsive" alt="Image">
                    </div>
                    <div class="col-xs-8 text-center">
                        <h3 style="margin-top: 5px;"><b>Quality Management Office</b></h3>
                        <h4><b>Request For Document</b></h4>
                    </div>      
                </div>   
                <hr>  
                <form action=" {{ url('/request-form') }} " method="POST" role="form">
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

                    <div class="row">
                        <div class="col-sm-6">
                            <label>QMO Branch</label>
                            <div class="radio3">
                                <input type="radio" id="radio1" name="branch" value="Main" 
                                @if(old('branch') == 'Main' || old('branch') == null) checked @endif>
                                <label for="radio1">
                                    Main
                                </label>
                            </div>
                            <div class="radio3">
                                <input type="radio" id="radio2" name="branch" value="Specific_branch" 
                                @if(old('branch') == 'Specific_branch') checked @endif>
                                <label for="radio2">
                                    Branch
                                </label>
                            </div>
                            <input type="text" class="form-control" id="" placeholder="Specify Branch" name="specific_branch" 
                            value="{{old('specific_branch')}}" 
                                style="width: 200px;">
                        </div>
                        <div class="col-sm-6">
                            <label>Nature Of request</label>
                            <div class="radio3">
                                <input type="radio" id="radio3" name="request_nature" value="New" checked>
                                <label for="radio3" @if(old('request_nature') == 'New' || old('nature') == null) checked @endif>
                                    New
                                </label>
                            </div>
                            <div class="radio3">
                                <input type="radio" id="radio4" name="request_nature" value="Revision"
                                @if(old('request_nature') == 'Revision') checked @endif >
                                <label for="radio4">
                                    Revision
                                </label>
                            </div>
                            <div class="radio3">
                                <input type="radio" id="radio5" name="request_nature" value="Deletion" 
                                @if(old('request_nature') == 'Deletion') checked @endif >
                                <label for="radio5">
                                    Deletion
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Request #</label>
                                <input type="text" class="form-control " disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Request Date</label>
                                <input type="text" class="form-control " disabled value="{{date('m/d/Y')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Document Title</label>
                        <input type="text" class="form-control input-lg" name="document_title" value="{{ old('document_title') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Description of the Request</label>
                        <textarea type="text" class="form-control input-lg"
                        rows="5" name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Reason of the Request</label>
                        <textarea type="text" class="form-control input-lg"
                        rows="5" name="reason">{{ old('reason') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Request By</label>
                        <input type="text" class="form-control input-lg" id="" placeholder="Your name here..." name="request_by" value="{{ old('request_by') }}">
                    </div>
                            
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control input-lg" id="" placeholder="Maybe we can email you..." name="email" value="{{ old('email') }}">
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

