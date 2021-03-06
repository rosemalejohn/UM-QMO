@extends('layouts.guest')

@section('content')
<form class="login-form" action="{{ url('/login') }}" method="post">
    {{ csrf_field() }}
    <h3 class="form-title">Sign In</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Enter any username and password. </span>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success uppercase">Login</button>
        <label class="rememberme check">
            <input type="checkbox" name="remember" value="1" />Remember
        </label>
    </div>
    <div class="create-account">
        <p>
            <a href="/password/reset" class="uppercase">Forgot Password</a>
        </p>
        <p>
            <a href="/request-form" class="uppercase">Request Form</a>
        </p>
    </div>
</form>
@endsection
