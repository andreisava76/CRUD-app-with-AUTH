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
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @can('admin')
                <td class="actions-td">
                    <a id="add" title="Add" data-toggle="tooltip" data-id='{{ $user->id }}'><i
                            class="material-icons green cursor-pointer p-1">&#xE03B;</i></a>
                    <a id="edit" title="Edit" data-toggle="tooltip" data-id='{{ $user->id }}'><i
                            class="material-icons yellow cursor-pointer p-1">&#xE254;</i></a>
                    <a id="delete" title="Delete" data-toggle="tooltip" data-id='{{ $user->id }}'><i
                            class="material-icons red cursor-pointer p-1">&#xE872;</i></a>
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
