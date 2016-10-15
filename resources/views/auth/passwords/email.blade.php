@extends('layouts.guest')

<!-- Main Content -->
@section('content')
    <form action="{{ url('/password/email') }}" method="POST">
        {{ csrf_field() }}
        <h3>Forget Password ?</h3>
        <p>
            Enter your e-mail address below to reset your password.
        </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
        </div>
        <div class="form-actions">
            <a href="/login" type="button" class="btn btn-default">Back</a>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
@endsection
