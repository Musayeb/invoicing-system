@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
    <div class="card p-3">
        <div class="btn-list ">
                <a href="javascript:viod();" data-backdrop="static" data-toggle="modal" data-target="#create"
                    class="pull-right btn btn-primary d-inline"><i class="ti-plus"></i> &nbsp;Add New client</a>
        </div>

        <div class="mt-5 table-responsive">
            <table class="table table-striped table-bordered table-sm text-nowrap w-100 dataTable no-footer" id="example" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th>Author</th>
                        <th>Register Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1; @endphp
                    @foreach ($clients as $row)
                
                        <tr id="row{{ $row->client_id }}" >
                            <td> {{$counter++}} </td>
                            <td> {{$row->full_name}} </td>
                            <td> {{$row->phone}} </td>
                            <td> {{$row->email}} </td>
                            <td> {{$row->address}} </td>
                            <td> {{$row->emails}}</td>
                            <td> {{$row->created_at}}</td>
                            <td>
                                <a  data-id="{{$row->client_id}}"  class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                                <a  data-id="{{$row->client_id}}"  data-toggle="modal" data-target="#edit"  class="btn btn-info btn-sm text-white mr-2 edit">Edit</a>
                            </td>
                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div id="create" class="modal fade">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add client</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert  alert-danger">
                        <ul id="error"></ul>
                    </div>
                    <form method="post" id="createform">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input name="full_name"  type="text"  class="form-control" placeholder="Full name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone_number" type="number" class="form-control" placeholder="Phone Number" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email_address" type="email" class="form-control" placeholder="Email Address" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input name="address" type="text" class="form-control" placeholder="Address" autocomplete="off">
                        </div>
                        <div class="modal-footer  mt-2">
                            <button type="submit" class="btn btn-primary">Create client</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>

    <div id="edit" class="modal fade">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Edit client</h6>
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
                            <label>Full Name</label>
                            <input name="full_name"  type="text"  class="form-control" placeholder="Full name" autocomplete="off" id="name">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone_number" type="number" class="form-control" placeholder="Phone Number" autocomplete="off" id="phone">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email_address" type="email" class="form-control" placeholder="Email Address" autocomplete="off" id="email">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Address" autocomplete="off">
                        </div>
                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <button type="submit" class="btn btn-primary">Update client</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->

            </div>
        </div><!-- MODAL DIALOG -->
    </div>


@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">clients</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script>
        $('#example').DataTable();
        $('.alert').hide();
    </script>


    <script>

        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("clients") }}',
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
            $.get('{{ url("clients") }}' + '/' + $(this).attr('data-id') + '/' + "edit", function(data) {
                $('#name').val(data.full_name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#address').val(data.address);
                $('#hidden_id').val(data.client_id);
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
                url: '{{ url("client_update") }}',
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
                    url:'{{url("clients")}}/'+id,
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
                      'client has related data first delete departments data',
                      'error'
                        )
                    }
                 });
                }
            })
              
        });

    
    </script>

@endsection
