@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold">Update Cuisine</div>

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

                    <form method="POST" action="{{ route('cuisine.update', [$cuisine->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" value="{{ $cuisine->name }}" name="name" class="form-control"
                                placeholder="Name...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Image</label>
                            <br>
                            <input type="file" name="image" class="form-control-file" accept="image/*">
                            <img src="{{ asset('public/uploads/cuisine/' . $cuisine->image) }}" width="100">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category</label>
                            <select class="form-select" name="category" aria-label="Default select example">
                                @foreach ($cate as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('category_id', $cuisine->category_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Difficulty</label>
                            <select class="form-select" name="difficulty" aria-label="Default select example">
                                <option value="Dễ" {{ $cuisine->difficulty == 'Dễ' ? 'selected' : '' }}>Dễ</option>
                                <option value="Trung bình" {{ $cuisine->difficulty == 'Trung bình' ? 'selected' : '' }}>
                                    Trung bình
                                </option>
                                <option value="Khó" {{ $cuisine->difficulty == 'Khó' ? 'selected' : '' }}>Khó</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Duration</label>
                            <input type="int" value="{{ $cuisine->duration }}" name="duration" class="form-control"
                                placeholder="duration...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ingredients</label>
                            <Textarea name="ingredients" class="form-control" placeholder="Ingredients...">{{ $cuisine->ingredients }}</Textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Steps</label>
                            <Textarea name="steps" class="form-control" placeholder="Steps...">{{ $cuisine->steps }}</Textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Website URL</label>
                            <input type="int" value="{{ $cuisine->websiteURL }}" name="websiteURL" class="form-control"
                                placeholder="Website URL...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Youtube URL</label>
                            <input type="text" value="{{ $cuisine->youtubeURL }}" name="youtubeURL" class="form-control"
                                placeholder="Youtube URL...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Default select example">

                                @if ($cuisine->status == '0')
                                    <option selected value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Disapproved</option>
                                @else
                                    @if ($cuisine->status == '1')
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
