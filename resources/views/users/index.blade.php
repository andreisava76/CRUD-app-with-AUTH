@extends("layouts.app")
@section("content")
    <x-container name="users">
        <x-table :users="$users"/>
    </x-container>
@endsection
@push('js')
    <script>
        const inputs = @json($inputs);
        const deleteRoute = @json(route('user.destroy'));
        const updateRoute = @json(route('user.update'));
        const storeRoute = @json(route('user.store'));
        const actions = `<x-actions/>`;
        const toast = `<x-toast/>`;
        @if (session()->has('success'))
        $(() => {
            $("#app").append(`<x-flash/>`)
            $('.toast').toast('show');
        })
        @endif
    </script>
    <script type="module" src='{{ asset('js/user.js') }}'></script>
@endpush
