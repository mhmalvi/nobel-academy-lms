@extends('admin.layouts.app')

@push('css')
    <style>
        .actions a:nth-child(even){
            padding: 0px 8px;
            border-left: 1px solid #e4e4e4;
            border-right: 1px solid #e4e4e4;
        }
    </style>
@endpush

@section('content')
    <div class="container">
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
                        <td width="20%">
                            {{$item->name}}

                            <div class="text-left mt-2 actions">
                                <a href="">View</a>
                                <a href="">Edit</a>
                                <a href="">Trash</a>
                            </div>
                        </td>
                        <td width="20%">{{$item->email}}</td>
                        <td width="10%">{{$item->user_type}}</td>
                        <td width="40%">
                            <p>
                                Full Name:
                            </p>
                            <p>
                                Phone:
                            </p>
                            <p>
                                Address:
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
                    
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
