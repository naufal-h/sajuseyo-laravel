@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/list-product.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper">
                <div>
                    <h1>Users</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                        <span><img src="/assets/svg/arrow-down.svg" style="transform: rotate(-90deg)"
                                alt="" /></span>Users
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="dataTables_wrapper">
                                <div class="top-information">
                                    <div class="dataTables_filter">
                                        <form action="{{ route('admin.users') }}" method="GET" id="search-form">
                                            <label>Search &nbsp;<input type="search" name="search" class="form-search"
                                                    placeholder="" value="{{ request()->query('search') }}" /></label>
                                        </form>
                                    </div>
                                </div>
                                <table class="table dataTable no-footer" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 80.8px">Profile</th>
                                            <th style="width: 70.137px">ID</th>
                                            <th style="width: 250.4875px">Name</th>
                                            <th style="width: 300.85px">Email</th>
                                            <th style="width: 100.925px">Phone</th>
                                            <th style="width: 90.137px">Purchases</th>
                                            <th style="width: 150.925px">Created At</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            @if ($user->id == 1)
                                            @else
                                                <tr>
                                                    <td>
                                                        @if ($user->profile_picture)
                                                            <img class="thumbnail"
                                                                src="{{ asset('storage/' . $user->profile_picture) }}" />
                                                        @else
                                                            <img class="thumbnail"
                                                                src="https://dummyimage.com/765x765/eab8c1/ffffff.jpg&text=Insert+Image+Here+(1:1+Ratio)" />
                                                        @endif

                                                    </td>
                                                    <td>
                                                        {{ $user->id }}
                                                    </td>

                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>

                                                        {{ $user->orders->count() }}
                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->links('vendor.pagination.admin') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
