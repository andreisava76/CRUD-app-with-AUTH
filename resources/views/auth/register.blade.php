@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <section data-contact-info>
                                <div class="row mb-3">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="mobile_number"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                                    <div class="col-md-6">
                                        <input id="mobile_number" type="text"
                                               class="form-control @error('mobile_number') is-invalid @enderror"
                                               name="mobile_number" value="{{ old('mobile_number') }}">

                                        @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="btn btn-primary" data-next-section>
                                            {{ __('Next') }}
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section data-verification-code class="d-none">
                                <div class="row mb-3">
                                    <label
                                        class="col-form-label col-md-6 offset-md-4">{{ __('How would you like to get your verification code?') }}</label>
                                    <div class="form-check col-md-6 offset-md-4">
                                        <input class="form-check-input" type="radio" name="verificationCodeCheck" value="smsCheck"
                                               id="smsCheck" checked>
                                        <label class="form-check-label" for="smsCheck" data-label-sms-check>
                                            {{ __('SMS') }}
                                        </label>
                                    </div>
                                    <div class="form-check col-md-6 offset-md-4">
                                        <input class="form-check-input" type="radio" name="verificationCodeCheck" value="emailCheck"
                                               id="emailCheck">
                                        <label class="form-check-label" for="emailCheck" data-label-email-check>
                                            {{ __('Email') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('div[data-next-section]').on('click', () => {
            $('[data-contact-info]').addClass('d-none')
            $('[data-verification-code]').removeClass('d-none')
            $('[data-label-sms-check]').text('SMS '+  $('#mobile_number').val())
            $('[data-label-email-check]').text('Email '+  $('#email').val())
        })
    </script>
@endpush

