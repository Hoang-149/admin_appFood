@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center pt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Add Category</div>

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

                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                placeholder="Name...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Image</label>
                            <br>
                            <input type="file" name="hinhanh" class="form-control-file" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="0">Enable</option>
                                <option value="1">Disable</option>
                            </select>
                        </div>

                        <button type="submit" name="addUser" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
