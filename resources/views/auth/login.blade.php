@extends('auth.layout')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content" style="width: 600px">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form" style="width: 600px">
                                <div class="text-center mb-3">
                                    <a href="{{ route('fe.home.index') }}"><img
                                            src="{{ asset('templates/fe/img/logo/logo.png') }}" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Đăng nhập tài khoản của bạn</h4>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="mb-1"><strong>Email</strong></label>
                                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}"  autocomplete="email"
                                               >
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="mb-1"><strong>Mật khẩu</strong></label>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"  autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Ghi nhớ đăng nhập') }}
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="">Quên mật khẩu?</a>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block"
                                                style="background: #ff5400;border-color: #ff5400">Đăng nhập
                                        </button>

                                    </div>
                                </form>
                                <div class="new-account mt-3 row">
                                    <div class="col">
                                        <p>Bạn chưa có tài khoản ? <a  style="color: #ff5400" href="{{ route('fe.auth.register') }}">Đăng
                                                Ký</a></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-3 row">
                                    <div class="col">
                                        <a href="{{ route('google.redirect') }}">
                                            <img src="https://one.systemonesoftware.com/images/btn_google_signin_dark_normal_web@2x.png" style="margin-left: 3em;height: 45px">
                                        </a>
                                        <a href="{{ route('facebook.redirect') }}">
                                            <img src="https://one.systemonesoftware.com/images/btn_facebook_signin_dark_normal_web@2x.png" style="margin-left: 3em;height: 45px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
