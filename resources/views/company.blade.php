@extends('admin')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <h3>Company</h3>

            @if (session('comnpany'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('comnpany') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <hr>
            <form method="POST" enctype="multipart/form-data" action="{{ route('company_insert') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="">CompanyName</label>
                        <input type="text" name="company" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Address</label>
                        <input type="text" name="address" required class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Phone</label>
                        <input type="text" name="phone" required class="form-control">
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
                            <th>Id</th>
                            <th>CompanyName</th>
                            <th>Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($company as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->companyname }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $item->id }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $item->id }}">Delete</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete{{ $item->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <h3>Are you sure delete <span
                                                    class="text-danger">{{ $item->companyname }}</span> </h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <a href="{{ route('DeleteCompany', $item->id) }}"
                                                class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="edit{{ $item->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('company_update', $item->id) }}">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">CompanyName</label>
                                                    <input value="{{ $item->companyname }}" type="text"
                                                        name="company" required class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <input value="{{ $item->address }}" type="text" name="address"
                                                        required class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input value="{{ $item->phone }}" type="text" name="phone"
                                                        required class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" id="submits" class="btn btn-primary"><span
                                                        style="display: none" class="spinner-border spinner-border-sm d"
                                                        role="status" aria-hidden="true"></span>Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script></script>
@endsection
