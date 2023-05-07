@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center pt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Add User</div>

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

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">User Name</label>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                placeholder="Username...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Photo</label>
                            <br>
                            <input type="file" name="image" class="form-control-file" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" value="{{ old('email') }}" name="email" class="form-control"
                                placeholder="Email...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <input type="text" value="{{ old('address') }}" name="address" class="form-control"
                                placeholder="Address...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Role</label>
                            <select class="form-select" name="role" aria-label="Default select example">
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="0">Enable</option>
                                <option value="1">Disable</option>
                            </select>
                        </div>

                        <button type="submit" name="addUser" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
