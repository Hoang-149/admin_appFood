@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center pt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Edit User</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form method="POST" action="{{ route('users.update', [$user->id]) }}" enctype="multipart/form-data">
                        {{-- @method('PUT') --}}
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">User Name</label>
                            <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                                placeholder="Username...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Photo</label>
                            <br>
                            <input type="file" name="image" class="form-control-file" accept="image/*">
                            <img src="{{ asset('public/uploads/users/' . $user->image) }}" width="100">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" value="{{ $user->email }}" name="email" class="form-control"
                                placeholder="Email...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example">

                                @if ($user->role == '0')
                                    <option selected value="0">User</option>
                                    <option value="1">Admin</option>
                                @else
                                    <option value="0">User</option>
                                    <option selected value="1">Admin</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">

                                @if ($user->status == '0')
                                    <option selected value="0">Enable</option>
                                    <option value="1">Disable</option>
                                @else
                                    <option value="0">Enable</option>
                                    <option selected value="1">Disable</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" name="addUser" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
