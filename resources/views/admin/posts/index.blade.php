@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center  pt-5">
        <div class="col-md-12">
            <div class="pb-3 d-flex justify-content-between">
                <a href="#" class="btn btn-secondary">ADD POST</a>
                <form class="d-none d-md-inline-block form-inline ms-auto" action="{{ route('post.index') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="term" placeholder="Search..."
                            aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header fw-bold">List Post</div>

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
                                <th scope="col">Content</th>
                                <th scope="col">Name Recipes</th>
                                <th scope="col">Author</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($posts as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->cuisine->name }}</td>
                                    <td>{{ $item->user->name }}</td>

                                    {{-- <td>{{ $item->favourite_count }}</td> --}}

                                    <td><?php if ($item->status == '0') {
                                        echo 'Pending';
                                    } elseif ($item->status == '1') {
                                        echo 'Approved';
                                    } else {
                                        echo 'Disapproved';
                                    } ?></td>

                                    <td>
                                        <div class="d-flex">

                                            <a href="{{ route('post.edit', [$item->id]) }}" class="btn btn-success me-1"><i
                                                    class="fas fa-pen "></i></a>
                                            <form action="{{ route('post.destroy', [$item->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa bài post này không?')"
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
