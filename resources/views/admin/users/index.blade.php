@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center  pt-5">
        <div class="col-md-12">
            <div class="pb-3 d-flex justify-content-between">
                <a href="{{ route('users.create') }}" class="btn btn-primary">ADD USER</a>
                <form class="d-none d-md-inline-block form-inline ms-auto" action="{{ route('users.index') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="term" placeholder="Search..."
                            aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header fw-bold">LIST USER</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Recipes</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($users as $user)
                                @php
                                    $cuisineCount = $usersWithCuisineCount[$loop->index];
                                @endphp
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td><img class="rounded-circle"
                                            src="{{ asset('public/uploads/users/' . $user->image) }}" alt=""
                                            width="70" height="70"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role == '1' ? 'Admin' : 'User' }}</td>
                                    <td>{{ $cuisineCount->cuisine_count }}</td>

                                    <td>
                                        <p class="{{ $user->status == '0' ? 'text-success' : 'text-danger' }}">
                                            {{ $user->status == '0' ? 'Enable' : 'Disable' }}</p>
                                    </td>

                                    <td>
                                        <div class="d-flex">

                                            <a href="{{ route('users.edit', [$user->id]) }}"
                                                class="btn btn-success me-1"><i class="fas fa-pen "></i></a>
                                            <form action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa user này không?')"
                                                    class="btn btn-danger"><i class="fas fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
