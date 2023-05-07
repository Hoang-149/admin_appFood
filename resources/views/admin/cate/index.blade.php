@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center  pt-5">
        <div class="col-md-12">
            <div class="pb-3 d-flex justify-content-between">
                <a href="{{ route('category.create') }}" class="btn btn-primary">ADD CATEGORY</a>
                <form class="d-none d-md-inline-block form-inline ms-auto" action="{{ route('category.index') }}"
                    method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="term" placeholder="Search..."
                            aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header fw-bold">List User</div>

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
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($category as $cate)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $cate->name }}</td>
                                    <td><img src="{{ asset('public/uploads/cate/' . $cate->image) }}" alt=""
                                            width="100"></td>
                                    <td>
                                        <p class="{{ $cate->status == '0' ? 'text-success' : 'text-danger' }}">
                                            {{ $cate->status == '0' ? 'Enable' : 'Disable' }}</p>
                                    </td>

                                    <td>
                                        <div class="d-flex">

                                            <a href="{{ route('category.edit', [$cate->id]) }}"
                                                class="btn btn-success me-1"><i class="fas fa-pen "></i></a>
                                            <form action="{{ route('category.destroy', [$cate->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa danh mục này không?')"
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
