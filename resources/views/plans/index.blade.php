@extends("layouts.app")
@push('css')
    <link rel="stylesheet" href="{{ asset('css/plans.css') }}">
@endpush
@section("content")
    <section>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <div class="title">
                                <h2>{{ __('Basic') }}</h2>
                            </div>
                            <div class="price">
                                <h4>50<sup>€</sup></h4>
                            </div>
                            <div class="option">
                                <ul>
                                    <li>Option 1</li>
                                    <li>Option 2</li>
                                    <li>Option 3</li>
                                    <li>Option 4</li>
                                </ul>
                            </div>
                            <a href="#">Order Now </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <div class="title">
                                <h2>{{ __('Standard') }}</h2>
                            </div>
                            <div class="price">
                                <h4>100<sup>€</sup></h4>
                            </div>
                            <div class="option">
                                <ul>
                                    <li>Option 1</li>
                                    <li>Option 2</li>
                                    <li>Option 3</li>
                                    <li>Option 4</li>
                                </ul>
                            </div>
                            <a href="#">Order Now </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <div class="title">
                                <h2>{{ __('Premium') }}</h2>
                            </div>
                            <div class="price">
                                <h4>150<sup>€</sup></h4>
                            </div>
                            <div class="option">
                                <ul>
                                    <li>Option 1</li>
                                    <li>Option 2</li>
                                    <li>Option 3</li>
                                    <li>Option 4</li>
                                </ul>
                            </div>
                            <a href="#">Order Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
@endpush
