@extends('admin')
@section('content')
    <div class="content-wrapper">
        <div class="container">

            @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $errors->first() }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('del'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('del') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h3>Student</h3>
            <form method="post" enctype="multipart/form-data" id="form_student" action="{{ route('save_student') }}">
                @csrf
                <div class="col-md-4">
                    <label for="">StudentName</label>
                    <input type="text" name="student" class="form-control required" placeholder="">
                </div>
                <div class="col-md-4">
                    <label for="">Grade</label>
                    <select name="gade" class="required form-control">
                        <option value="" selected disabled>selected grade</option>
                        <option>10</option>
                        <option>11</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Gender</label>
                    <select name="gender" class="required  form-control">
                        <option value="" selected disabled>selected a option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Pob</label>
                    <input type="text" class="required form-control" name="pob" placeholder="">
                </div>
                <div class="col-md-4">
                    <label for="">Phone</label>
                    <input type="number" class="required form-control" name="phone" placeholder="">
                </div>
                <div class="col-md-4">
                        <label for="image">Image</label>
                        <input type="file" name="photo" class="form-control required ">

                    </div>
                <hr>
                <div class="col-md-12">
                    <button type="submit" id="save" class="toggle-disabled btn btn-success" disabled> <span
                            class="spinner-border spinner-border-sm spin" style="display: none" role="status"
                            aria-hidden="true"></span>
                        Submit</button>
                </div>
            </form>
            <hr>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Grade</th>
                            <th>Gender</th>
                            <th>Pob</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($select as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->student }}</td>
                                <td>{{ $item->grade }}</td>
                                <td>{{ $item->sex }}</td>
                                <td>{{ $item->pob }}</td>
                                <td>{{ $item->phone }}</td>
                                <td align="center"><img src="upload/{{ $item->photo }}" class="img-thumbnail" width="40px" /></td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#edit{{ $item->id }}">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{ $item->id }}">Delete</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete{{ $item->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Are you sure delete <span class="text-danger">{{ $item->student }}</span>
                                            </h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <a href="{{ route('delete_item', $item->id) }}"
                                                class="btn btn-danger delete"><span
                                                    class="spinner-border spinner-border-sm loading" style="display:none"
                                                    role="status" aria-hidden="true"></span> Yes</a>
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
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" enctype="multipart/form-data" action="{{ route('update_item', $item->id) }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">StudentName</label>
                                                    <input type="text" name="student" value="{{ $item->student }}" class="form-control re"
                                                        placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Grade</label>
                                                    <select name="gade"  class="form-control ">
                                                        <option>10</option>
                                                        <option>11</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select name="gender"  class=" form-control ">

                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Pob</label>
                                                    <input type="text" class="form-control" value="{{ $item->pob }}" name="pob"
                                                        placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="number" class="form-control" value="{{ $item->phone }}" name="phone"
                                                        placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" name="photo"class="form-control ">
                                                    <img src="upload/{{ $item->photo }}" width="100px" alt="">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button
                                                    class="btn_enable btn btn-success update " > <span
                                                        class="spinner-border spinner-border-sm loading"
                                                    style="display: none" role="status" aria-hidden="true"></span>
                                                Update</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        $(document).on('change keyup', '.required', function(e) {
            let Disabled = true;
            $(".required").each(function() {
                let value = this.value
                if ((value) && (value.trim() != '')) {
                    Disabled = false
                } else {
                    Disabled = true
                    return false
                }
            });
            if (Disabled) {
                $('.toggle-disabled').prop("disabled", true);

            } else {
                $('.toggle-disabled').prop("disabled", false);

            }
        })


        //disable button
        $(document).ready(function() {
            $(document).on("submit", "#form_student", function() {
                $(".spinner-border").show();
                $('.toggle-disabled').prop("disabled", true);
            })
            // $(".delete").click(function() {
            //     $(".loading").show();
            //     // $(this).addClass('disabled')
            // })

            $(document).on("click", ".delete", function() {
                $(".loading").show();
                $(this).addClass('disabled')
            })

            $(document).on("click", ".update", function() {
                $(".loading").show();
                $(this).addClass('disabled')
            })
        })
    </script>
@endsection
