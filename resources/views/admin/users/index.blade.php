@extends('admin.layouts.app')

@section('title', 'All users')

    @push('css')
        <style>
            .actions a {
                padding: 0px 8px;
                border-left: 1px solid #e4e4e4;
                border-right: 1px solid #e4e4e4;
            }

        </style>
    @endpush

@section('content')
    <div class="container">
        <div class="btn-group mb-3">
            <a href="{{ route('admin.users') }}" class="btn btn-white">All</a>
            <a href="{{ route('admin.user.show', 'userType=teacher') }}" class="btn btn-white">Teachers</a>
            <a href="{{ route('admin.user.show', 'userType=student') }}" class="btn btn-white">Students</a>
            <a href="{{ route('admin.user.show', 'userType=staff') }}" class="btn btn-white">Staffs</a>
            <a href="{{ route('admin.user.trashed') }}" class="btn btn-white">Trashed</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>User Info</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $item)
                    <tr>
                        <td width="30%">
                            {{ $item->name }}
                            <div class="text-left mt-2 actions">
                                @if (is_null($item->deleted_at))
                                    <a href="{{ route('admin.user.profile', $item->id) }}">Profile</a>
                                    @if (!$item->isAdmin())
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Are you sure to delete?')){document.getElementById('user{{ $item->uuid }}').submit();}">Trash</a>
                                        <form action="{{ route('admin.user.remove', $item->id) }}" method="post"
                                            id="user{{ $item->uuid }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('admin.user.restore', $item->id) }}" method="post"
                                        id="restore{{ $item->uuid }}" class="d-none">
                                        @csrf
                                        @method('put')
                                    </form>
                                    <form action="{{ route('admin.user.destroy', $item->id) }}" method="post"
                                        id="destroy{{ $item->uuid }}" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a href="javascript:void(0)"
                                        onclick="document.getElementById('restore{{ $item->uuid }}').submit()">Restore</a>
                                    <a href="javascript:void(0)"
                                        onclick="document.getElementById('destroy{{ $item->uuid }}').submit()">Delete</a>
                                @endif
                            </div>
                        </td>
                        <td width="20%">{{ $item->email }}</td>
                        <td width="10%">{{ $item->user_type }}</td>
                        <td width="30%">
                            <p>
                                <strong>Full Name</strong>: &nbsp; {{ $item->info->getUserFullName() }}
                            </p>
                            <p>
                                <strong>Phone</strong>: &nbsp; {{ $item->info->phone }}
                            </p>
                            <p>
                                <strong>Address</strong>: &nbsp; {{ $item->info->address }}
                            </p>
                        </td>
                        <td width="10%">
                            @if ($item->isBanned == 'yes')
                                <span class="badge badge-info">Banned</span>
                            @else
                                <span class="badge badge-info">Active</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data Found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
