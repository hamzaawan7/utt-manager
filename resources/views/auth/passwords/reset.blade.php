@extends('auth.main')
@section('content')
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{asset('vendors/images/forgot-password.png')}}" alt="">
            </div>
            <div class="col-md-6">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">Reset Password</h2>
                    </div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group custom">
                            <input type="email" id="email" name="email" value="{{ old('email')}}"
                                   class="form-control @error('email') is-invalid @enderror form-control-lg"
                                   placeholder="Email" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-envelope-o"
                                                                  aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror form-control-lg"
                                   placeholder="Password" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" id="password-confirm"
                                   class="form-control @error('password') is-invalid @enderror form-control-lg"
                                   placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
