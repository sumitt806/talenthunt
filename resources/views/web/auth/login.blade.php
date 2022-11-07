@extends('web.layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>login</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ptb80" id="login">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <div class="login-box">
                    <div class="login-title">
                        <h4>login to {{ config('app.name') }}</h4>
                    </div>
                    <form method="POST" action="{{ route('front.login') }}">
                        @csrf
                        @include('layouts.errors')
                        @include('flash::message')
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email"
                                   value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}"
                                   autofocus required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                   placeholder="Your Password"
                                   value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="checkbox" name="remember" class="custom-control-input"
                                           id="remember" {{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                    <label for="remember">Remember me?</label>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-purple btn-effect">Login</button>
                            <a href="{{ route('front.register') }}" class="btn btn-purple btn-effect">signup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let registerSaveUrl = "{{ route('front.save.register') }}";
    </script>
    <script src="{{mix('assets/js/front_register/front_register.js')}}"></script>
@endsection
