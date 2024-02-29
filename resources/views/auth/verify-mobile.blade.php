@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verification') }}</div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ __('Thanks for signing up! Before getting started, you need to verify your mobile phone number.') }}
                        </div>
                        <div>
                            {{ __('Please enter the OTP sent to your number:') }} {{ auth()->user()->mobile_number }}
                        </div>
                        <div class="mt-4 items-center justify-between">
                            <form method="POST" action="{{ route('verification.verify-mobile') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="code"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Code') }}</label>

                                    <div class="col-md-6">
                                        <input id="code" type="text"
                                               class="form-control @error('code') is-invalid @enderror" name="code"
                                               value="{{ old('code') }}" required autofocus/>

                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0 mt-4">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verify') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
