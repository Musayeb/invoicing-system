@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />


    

@endsection
@section('content')
    <div class="card p-3">
        <div class="mt-5 table-responsive">
            <table class=" table card-table table-vcenter text-nowrap  align-items-center w-100 dataTable " id="example" >
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Invoice #</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1; @endphp
                    @foreach($incomes as $row)
                        <tr id="row{{$row->id}}" >
                            <td> {{$counter++}} </td>
                            <td>{{$row->invoice_id}}</td>
                            <td>{{$row->amount}}</td>
                            <th>{{$row->payment_method}}</th>
                            <td>{{$row->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
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
                            <input name="name"  type="text"  class="form-control" placeholder="Full name" autocomplete="off" id="name">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone" type="number" class="form-control" placeholder="Phone Number" autocomplete="off" id="phone">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" type="email" class="form-control" placeholder="Email Address" autocomplete="off" id="email">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input name="country" type="text" class="form-control" placeholder="Country" autocomplete="off" id="country">
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
    <li class="breadcrumb-item active" aria-current="page">Incomes</li>
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
                    url:'{{url("incomes")}}/'+id,
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
                      'Income has related data first delete departments data',
                      'error'
                        )
                    }
                 });
                }
            })
              
        });

    
    </script>
@endsection
