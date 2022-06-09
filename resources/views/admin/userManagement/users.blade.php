@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
    <!-- FILE UPLODE CSS -->
    <link href="{{ asset('public/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .table tr td{
           background:white !important;
       }
    </style>
@endsection
@section('content')
    <div class="card p-3">
        <div class="btn-list ">
                <a href="javascript:viod();" data-backdrop="static" data-toggle="modal" data-target="#create"
                    class="pull-right btn btn-primary d-inline create"><i class="ti-plus"></i> &nbsp;Add New User</a>
        </div>

        <div class="table-responsive table-md mt-5">
            <table class="table mb-0  text-nowrap w-100 dataTable no-footer" id="example">
                <thead class="thead-light">
                    <tr>
                        <th  class="text-center">#</th>
                        <th class="text-center">Profile Picture</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1;  @endphp
                    @foreach($users as $row)
                    <tr id="row{{$row->id}}">
                        <td class="align-middle text-center"> {{$counter++}} </td>
                        <td class="align-middle text-center">
                            @if (empty($row->profile_photo_path))
                                <img alt="image" class="avatar avatar-md rounded-circle" src="{{asset('public/assets/images/users/user-1.png')}}">
                            @else
                                <img alt="image" class="avatar avatar-md rounded-circle" src="{{asset('storage/app')}}/{{$row->profile_photo_path}}">
                            @endif
                        </td>
                        <td class="text-nowrap text-center align-middle">{{$row->name}}</td>
                        <td class="text-nowrap text-center align-middle"><span>{{$row->email}}</span></td>
                        <td class="align-middle text-center"> 
                            @if ($row->role=="Admin")
                                <span class="badge badge-secondary">{{$row->role}}</span> 
                            @else
                                <span class="badge badge-primary">{{$row->role}}</span> 
                            @endif
                        </td>
                        <td class="align-middle text-center"> 
                            @php
                                $date=date_create($row->created_at);
                                echo date_format($date,'Y-M-d');
                            @endphp 
                            <br>
                            <small class="text-muted">
                                @php
                                    $date=date_create($row->created_at);
                                    echo date_format($date,'h:i:s a');
                                @endphp 
                            </small>          
                        </td>
                        <td class="text-center align-middle">
                            <a  data-id="{{$row->id}}"  class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                            <a  data-id="{{$row->id}}"  data-toggle="modal" data-target="#edit"  class="btn btn-info btn-sm text-white mr-2 edit">Edit</a>
                            <a  data-id="{{$row->id}}"  data-toggle="modal" data-target="#reset_password"  class="btn btn-teal btn-sm text-white mr-2 reset">Reset Password</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>





    {{-- Create User --}}
    <div id="create" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert  alert-danger">
                        <ul id="error"></ul>
                    </div>
                    <form method="post" id="createform">
                        <div class="form-row ">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input name="user_name" type="text" class="form-control" placeholder="User Name"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input name="user_email" type="email" class="form-control email" placeholder="User Email"  autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-row mt-2">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>User Password</label>
                                    <input name="user_password" type="password" class="form-control password" placeholder="User Pasword"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password Confirm</label>
                                    <input name="password_confirm" type="password" class="form-control confirm" placeholder="Password Confirm"  autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select name="user_role" class="form-control" >
                                <option value="" selected disabled>Select User Role</option>
                                <option value="Manager">Manager</option>     
                                <option value="Admin">Admin</option>       
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>User Profile Picture <small>(MAX 500KB,jpg,jpeg,png)</small></label>
                            <input  name="user_photo" type="file" class="dropify mt-3" data-default-file="{{asset('public/assets/images/users/user-1.png')}}" data-height="180" data-max-file-size="0.5M"  />
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-primary">Create User</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>{{-- Create User --}}


    {{-- Update User --}}
    <div id="edit" class="modal fade">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Edit User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert alert1 alert-danger">
                        <ul id="error"></ul>
                    </div>
                    <form method="post" id="editform">
                        <div class="form-group">
                            <label>User Name</label>
                            <input name="user_name" type="text" class="form-control" placeholder="User Name"  autocomplete="off" id="user_name">
                        </div>
                        <div class="form-group mt-2">
                            <label>User Email</label>
                            <input name="user_email" type="email" class="form-control email" placeholder="User Email"  autocomplete="off" id="user_email">
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select name="user_role" class="form-control" id="user_role">
                                <option value="" selected disabled>Select User Role</option>
                                <option value="Manager">Manager</option>     
                                <option value="Admin">Admin</option>       
                            </select>
                        </div>
                        {{-- <div class="form-group mt-2">
                            <label>User Profile Picture  <small>(MAX 500KB,jpg,jpeg,png)</small></label>
                            <input  name="user_photo" type="file" class="dropify mt-3"  data-height="180" id="user_photo" data-max-file-size="0.5M"/>
                        </div> --}}
                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <button type="submit" class="btn btn-primary">Update User</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div> {{-- Update User --}}

    
    
    {{-- Reset Password User Modal  --}}
    <div id="reset_password" class="modal fade">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Reset Password</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert alert1 alert-danger">
                        <ul id="error"></ul>
                    </div>
                    <form method="post" id="editpassword">
                        <div class="form-group mt-3">
                            <label>Now Password</label>
                            <input name="user_password"  type="password" class="form-control password" placeholder="Now Pasword" id="user_password" autocomplete="off">
                        </div>
                        <div class="form-group mt-3">
                            <label>Password Confirm</label>
                            <input name="password_confirm" type="password" class="form-control confirm" placeholder="Password Confirm" id="password_confirm" autocomplete="off">
                        </div>
                        <div class="modal-footer mt-3 mb-3">
                            <input name="reset_password_id"  type="hidden" class="form-control password"  id="reset_password_id" autocomplete="off">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>{{--End Reset Password User Modal  --}}


@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>

        <!-- FILE UPLOADES JS -->
    <script src="{{ asset('public/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{ asset('public/assets/plugins/fileuploads/js/file-upload.js')}}"></script>

    <script>
        $('#example').DataTable();
        $('.alert').hide();
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (50kb max).'
            },
            height:180,
        });
    </script>

    <script>
        $('body').on('click', '.create', function() {
            $('.alert').hide();
            $('#createform')[0].reset();
        });
        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("users") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert").css('display', 'none');
                    $('.table').load(document.URL + ' .table');
                    $('#create').modal('hide');
                    $('#createform')[0].reset();
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert").find("ul").html('');
                    $(".alert").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert").find("ul").append('<li>' + value + '</li>');
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });


        $('body').on('click', '.edit', function() {
            id = $(this).attr('data-id');
            $('.alert').hide();
            url = '{{ url("users") }}' + '/' + id + '/' + "edit";
            $.get(url, function(data) {
                $('#user_name').val(data.name);
                $('#user_email').val(data.email);
                $('#user_role').val(data.role);
                $('#hidden_id').val(data.id);
            });
        });
        $("#editform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("user_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert1").css('display', 'none');
                    $('.table').load(document.URL + ' .table');
                    $('#edit').modal('hide');
                    $('#editform')[0].reset();
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert1").find("ul").html('');
                    $(".alert1").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert1").find("ul").append('<li>' + value + '</li>');
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        

        $('body').on('click','.delete',function(){  
            var id =$(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6          ',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
                $.ajax({
                        type:'DELETE',
                        url:'{{url("users")}}/'+id,
                        type:'Delete',
                        success:function(data){ 
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                        $('#row'+id).hide(1500);
                        },
                        error:function(error){
                        Swal.fire(
                        'Faild!',
                        'User has related data ',
                        'error'
                            )
                        }
                    });
                }
            })
        });


        $('body').on('click','.reset',function(){
            var id =$(this).attr('data-id');
            $('#reset_password_id').val(id);
            $('.alert').hide();
            $('#editpassword')[0].reset();
        });
        $("#editpassword").submit(function(e) {
            e.preventDefault();   
            var formData = new FormData(this);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
            $.ajax({
                url:'{{ url("resetPassword")}}',
                type: 'post',
                data: formData,
                success: function (data) {
                    $(".alert1").css('display','none');
                    $('.table').load(document.URL +  ' .table');
                    $('#reset_password').modal('hide');
                    $('#editpassword')[0].reset();
                        return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error:function(data){
                    $(".alert1").find("ul").html('');
                    $(".alert1").css('display','block');
                $.each( data.responseJSON.errors, function( key, value ) {
                        $(".alert1").find("ul").append('<li>'+value+'</li>');
                    });     
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
@endsection
