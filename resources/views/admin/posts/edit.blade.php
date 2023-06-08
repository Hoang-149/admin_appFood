@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center pt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Edit Post</div>

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


                    <form method="POST" action="{{ route('post.update', [$post->id]) }}" enctype="multipart/form-data">
                        {{-- @method('PUT') --}}
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Content</label>
                            <input type="text" value="{{ $post->title }}" name="title" class="form-control"
                                placeholder="Username...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">

                                @if ($post->status == '0')
                                    <option selected value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Disapproved</option>
                                @else
                                    @if ($post->status == '1')
                                        <option value="0">Pending</option>
                                        <option selected value="1">Approved</option>
                                        <option value="2">Disapproved</option>
                                    @else
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option selected value="2">Disapproved</option>
                                    @endif
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
