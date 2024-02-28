@extends("layouts.app")
@section("content")
    <x-container name="users">
        <x-table/>
    </x-container>
@endsection
@push('js')
    <script>
        const inputs = @json($inputs);
        const deleteRoute = @json(route('user.destroy'));
        const usersRoute = @json(route('user.index'));
        const updateRoute = @json(route('user.update'));
        const storeRoute = @json(route('user.store'));
        const toast = `<x-toast/>`;
        let isAdmin = false;
        @if (session()->has('success'))
        $(() => {
            $("#app").append(`<x-flash/>`)
            $('.toast').toast('show');
        })
        @endif
            @can('admin')
            isAdmin = true
        @endcan
    </script>
    <script type="module" src='{{ asset('js/user.js') }}'></script>
@endpush
