@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verification') }}</div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ __('Thanks for signing up! Before getting started, you need to verify your ') }} @if(auth()->user()->preffered_verification_method === 'email') email adress @else mobile number @endif
                        </div>
                        <div>
                            {{ __('Please enter the OTP sent to your ') }} @if(auth()->user()->preffered_verification_method === 'email') email adress: {{ auth()->user()->email }} @else mobile number: {{ auth()->user()->mobile_number }} @endif
                        </div>
                        <div class="mt-4 items-center justify-between">
                            <form method="POST" action="{{ route('verification.verify') }}">
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
    <x-flash/>
@endsection

@push('js')
    <script>
        @if (session()->has('success'))
        $(() => {
            $('.toast').toast('show');
        })
        @elseif(session()->has('errors'))
        $(() => {
            $('.toast').toast('show').removeClass("border-success-subtle").addClass("border-danger-subtle");
        })
        @endif
    </script>
@endpush

