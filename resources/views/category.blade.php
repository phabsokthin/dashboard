@extends('admin')
@section('content')
    <div class="content-wrapper">
        <div class="container">

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            <form method="POST" enctype="multipart/form-data" action="{{ route("insert_category") }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Category</label>
                        <input type="text" name="category" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Detail</label>
                        <textarea required name="detail" id="" cols="30" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group ml-2">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CategoryName</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item )
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{ $item->categoryname }}</th>
                                <th>{{ $item->detail }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
