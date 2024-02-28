@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('OTP Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('otp.generate') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="mobile_no" class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required placeholder="Enter your registered mobile number" autofocus>

                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Generate OTP') }}
                                    </button>

                                    @if (Route::has('login'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Login with email') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('auth.google') }}">{{ __('Login using Google') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
