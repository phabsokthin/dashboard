@extends('admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->

        <!-- Main content -->

        <div class="container">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h3>Product</h3>
            <form id="frm" method="POST" enctype="multipart/form-data" action="{{ route('save_product') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">ProductName</label>
                            <input type="text" name="pname" id="pname" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">CompanyName</label>
                            <select name="companyname" class="form-control" id="companyname">
                                @foreach ($company as $item)
                                    <option value="{{ $item->id }}">{{ $item->companyname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="categoryname" class="form-control" id="categoryname">
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->categoryname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="text" name="qty" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" id="save" class="btn btn-success"> <span style="display: none"
                                class="spinner-border spinner-border-sm d" role="status" aria-hidden="true"></span>
                        Save</button>
                    </div>
                </div>
            </form>

            <hr>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ProductName</th>
                            <th>Company</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->productname }}</td>
                                <td>{{ $item->companyname }}</td>
                                <td>{{ $item->categoryname }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#save").click(function(){
                $('.d').show();
            })

        })
    </script>
@endsection
