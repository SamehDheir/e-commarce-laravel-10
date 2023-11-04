@extends('back.layout.auth-layout')

@section('pageTitle')
    login
@endsection

@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Admin Login`</h2>
        </div>
        <form method="POST" action="{{ route('admin.login_handler') }}">
            @csrf

            @if (Session::get('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" placeholder="Username" name="login_id"
                    value="{{ isset($_COOKIE['email']) ? $_COOKIE['email'] : old('login_id') }}" />
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
            @error('login_id')
                <span class="text-danger"
                    style="margin-top: -20px; margin-bottom: 30px; display: block">{{ $message }}</span>
            @enderror

            <div class="input-group custom">
                <input type="password" class="form-control form-control-lg"
                    @if (isset($_COOKIE['password'])) value="{{ $_COOKIE['password'] }}" @endif placeholder="**********"
                    name="password" />
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>

            @error('password')
                <span class="text-danger"
                    style="margin-top: -20px; margin-bottom: 30px; display: block">{{ $message }}</span>
            @enderror
            <div class="row pb-30">
                <div class="col-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remmber_me" class="custom-control-input" id="customCheck1" />
                        <label class="custom-control-label" for="customCheck1">Remember</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="forgot-password">
                        <a href="#">Forgot Password</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                        {{-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</a> --}}
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
