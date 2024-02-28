@props(['users'])
<div class="table-responsive">
    <table class="table table-bordered table-hover" data-table>
        <thead class="table-primary">
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            @can('admin')
                <th class="text-center">{{ __('Actions') }}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
