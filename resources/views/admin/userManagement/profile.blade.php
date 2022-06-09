@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
   
@endsection
@section('content')
    


        
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <div class="card" style="margin-top:80px;">
                    <div class="userlist">
                        <div class="card-body text-center">
                            <div class="userprofile mt-0">
                                <div class="wideget-user-img shadow profile_img" style="margin-top:-100px; margin-bottom:50px;">
                                    @if (empty($user->profile_photo_path))
                                        <img class="" src="{{asset('public/assets/images/users/user-1.png')}}" alt="img">
                                    @else
                                        <img class="" src="{{asset('storage/app/')}}/{{$user->profile_photo_path}}" alt="img">
                                    @endif
                                </div>
                                <h3 class="username text-dark fs-18 font-weight-semibold">{{$user->name}}</h3>
                                <p class="mb-1 mt-2 text-body"><span class="badge badge-success px-5">{{$user->role}}</span></p>
                            </div>
                            <p class="mb-0"><span class=""> </span><br><a href="" class="text-info">{{$user->email}}</a></p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="text-center ">
                            <div class="flex-c-m ">
                                <a href="#" class="login100-social-item bg1">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="login100-social-item bg2">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="login100-social-item bg3">
                                    <i class="fa fa-google"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="card panel-theme">
                    <div class="card-header">
                        <div class="float-left">
                            <h3 class="card-title">Edit Profile Picture</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <form method="post" id="editphoto">
                        <div class="card-body no-padding">
                            <div class=" userprofile">
                                <div class="alert alert1 alert-danger alert-photo" style="font-size:12px">
                                    <ul id="error"></ul>
                                </div>
                                <div class="userpic mb-2">
                                    @if (empty($user->profile_photo_path))
                                        <img class="userpicimg" src="{{asset('public/assets/images/users/user-1.png')}}" name="user_img" alt="img" id="uploadUpdate" style="width:90px;height:90px;">
                                    @else
                                        <img class="userpicimg" src="{{asset('storage/app/')}}/{{$user->profile_photo_path}}" name="user_img" alt="img" id="uploadUpdate" style="width:90px;height:90px;">
                                    @endif
                                </div>
                                <p class="text-center">{{$user->name}}</p>


                                <div class="text-center">
                                    <div class="custom-file mb-4">
                                        <input type="hidden" name="hidden_id" value="{{$user->id}}">
                                        <input type="file" class="custom-file-input"  name="user_photo" onChange="UpdatePreview()" >
                                        <label class="custom-file-label"><i class="fe fe-camera mr-1 mb-2"></i>Change Photo</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer  mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
                    </div>
                    <form method="post" id="editform">
                        <div class="card-body">
                            <div class="alert alert1 alert-danger alert-profile">
                                <ul id="error"></ul>
                            </div>
                            <div class="form-group">
                                <label>Your Name</label>
                                <input name="user_name" type="text" class="form-control" placeholder="User Name"  autocomplete="off" value="{{$user->name}}" id="user_name">
                                <input type="hidden" name="user_role" value="{{$user->role}}">
                            </div>
                            <div class="form-group mt-2">
                                <label>Your Email Address</label>
                                <input name="user_email" type="email" class="form-control email" placeholder="User Email"  autocomplete="off" value="{{$user->email}}" id="user_email">
                            </div>
                            
                        </div>
                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="hidden_id" id="hidden_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    <form method="post" id="editpassword">
                        <div class="card-body">
                            <div class="alert alert1 alert-password alert-danger">
                                <ul id="error"></ul>
                            </div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="old_password" placeholder="Old Pasword" autocomplete="off" id="old_password">
                            </div>
                            <div class="form-group mt-3">
                                <label>Now Password</label>
                                <input name="user_password"  type="password" class="form-control password" placeholder="Now Pasword" autocomplete="off" id="user_password">
                            </div>
                            <div class="form-group mt-3">
                                <label>Password Confirm</label>
                                <input name="password_confirm" type="password" class="form-control confirm" placeholder="Password Confirm"  autocomplete="off" id="password_confirm">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <input name="reset_password_id"  type="hidden" class="form-control password" autocomplete="off" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary password-btn">Change Password</button>
                        </div>
                    </form>
                </div>
            
            </div>
        </div>
        <!-- ROW-1 CLOSED -->






@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        $('.alert').hide();
    </script>

    <script>
       

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
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert-profile").find("ul").html('');
                    $(".alert-profile").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        if(key=='user_name'){
                            $('#user_name').addClass(' is-invalid');
                        }
                        if(key=='user_email'){
                            $('#user_email').addClass(' is-invalid');
                        }
                       
                        $(".alert-profile").find("ul").append('<li>' + value + '</li>');
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
        

        $("#editpassword").submit(function(e) {
            e.preventDefault();   
            var formData = new FormData(this);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
            $.ajax({
                url:'{{ url("ChangePassword")}}',
                type: 'post',
                data: formData,
                success: function (data) {
                    $(".alert1").css('display','none');
                    if(data=='success'){
                        $('#editpassword')[0].reset();
                        $('#old_password').removeClass(' is-invalid');
                        $('#user_password').removeClass(' is-invalid');
                        $('#password_confirm').removeClass(' is-invalid');
                        return $.growl.notice({
                            message: 'Password change successfully',
                            title: 'Success !',
                        });
                    }else if (data=='error'){
                        $('#old_password').addClass(' is-invalid');
                        return $.growl.error({
                            message: 'Password invalid',
                            title: 'Error !',
                        });
                    }
                },
                error:function(data){

                $(".alert-password").find("ul").html('');
                $.each( data.responseJSON.errors, function( key, value ) {
                        if(key=='old_password'){
                            $('#old_password').addClass(' is-invalid');
                        }
                        if(key=='user_password'){
                            $('#user_password').addClass(' is-invalid');
                        }
                        if(key=='old_password'){
                            $('#password_confirm').addClass(' is-invalid');
                        }
                        $(".alert-password").css('display', 'block');
                        $(".alert-password").find("ul").append('<li>' + value + '</li>');
                    });     
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });


        $('#user_name').on('keypress',function(){
            $('#user_name').removeClass(' is-invalid');
        });
        $('#user_email').on('keypress',function(){
            $('#user_email').removeClass(' is-invalid');
        });
        $('#old_password').on('keypress',function(){
            $('#old_password').removeClass(' is-invalid');
        });
        $('#user_password').on('keypress',function(){
            $('#user_password').removeClass(' is-invalid');
        });
        $('#password_confirm').on('keypress',function(){
            $('#password_confirm').removeClass(' is-invalid');
        });



        function UpdatePreview(){
            $('#uploadUpdate').attr('src', URL.createObjectURL(event.target.files[0]));
        };



        
        $("#editphoto").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("ChangePhoto") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert1").css('display', 'none');

                    $('.profile_img').load(document.URL + ' .profile_img');
                    // 
                    console.log(data);
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                
                error: function(data) {
                    $(".alert-photo").find("ul").html('');
                    $(".alert-photo").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        if(key=='user_name'){
                            $('#user_name').addClass(' is-invalid');
                        }
                        $(".alert-photo").find("ul").append('<li>' + value + '</li>');
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
        
       
    </script>
@endsection
