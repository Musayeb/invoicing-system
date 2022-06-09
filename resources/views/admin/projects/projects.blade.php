@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" defer/>
    <style>
        .select2-selection{
           background:#f5f6fa !important;
       }

       .table-invoice tr th{
           font-size: 13px !important;
       }
   </style>


@endsection
@section('content')
    <div class="card p-3">
        <div class="btn-list ">
                <a href="javascript:viod();" data-backdrop="static" data-toggle="modal" data-target="#create"
                    class="pull-right btn btn-primary d-inline" id="createNewProject"><i class="ti-plus"></i> &nbsp;Add New Project</a>
        </div>
        <div class="mt-5 table-responsive">
            <table class="table table-striped table-bordered table-sm text-nowrap w-100 dataTable no-footer project_table" id="example" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Clinet</th>
                    
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1; @endphp
                    @foreach ($projects as $row)

                        <tr id="row{{ $row->id }}" >
                            <td> {{$counter++}} </td>
                            <td> {{$row->project_name}} </td>
                            <td> {{$row->start_date}} </td>
                            <td> {{$row->end_date}} </td>
                            <td> {{$row->client_email}} </td>

                            
                            <td> 
                             
                            {{$row->budget}} </td>
                        
                            <td>
                                @if ($row->status=='Not Started')
                                    <span class="badge badge-warning  ml-2 ">  {{$row->status}} </span>
                                @elseif($row->status=='In Progress')
                                    <span class="badge badge-info  ml-2 ">  {{$row->status}} </span>
                                @elseif($row->status=='Finished')
                                    <span class="badge badge-success ml-2  ">  {{$row->status}} </span>     
                                @elseif($row->status=='Cancelled')
                                    <span class="badge badge-danger ml-2 ">  {{$row->status}} </span>
                                @endif
                            </td>

                            <td>
                                <a   href="{{url('projects')}}/{{$row->project_id}}"  class="btn btn-success btn-sm text-white mr-2">View</a>
                                <a  data-id="{{$row->project_id}}"  class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                                <a  data-id="{{$row->project_id}}"  data-toggle="modal" data-target="#edit"  class="btn btn-info btn-sm text-white mr-2 edit">Edit</a>
                            </td>   
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    {{-- Create Project Modal --}}
    <div id="create" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add Project</h6>
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
                            <label>Project Name</label>
                            <input name="project_name"  type="text"  class="form-control" placeholder="Project name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Client</label>
                            <select name="client" class="form-control  select2-selection">
                                <option value="" selected disabled>Select</option>
                                @foreach ($clients as $row)
                                    <option value="{{$row->client_id}}" >{{$row->full_name }} |  {{  $row->email}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-row mt-2">
                            <div class="col">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input name="start_date" type="date" class="form-control"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input name="end_date" type="date" class="form-control"  autocomplete="off">
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control select2-selection">
                                <option value="" selected disabled>Select </option>
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Finished">Finished</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                          </div>
                          <div class="form-row mt-2">
                            <div class="col">
                                <div class="form-group">
                                    <label>Budget</label>
                                    <input name="budget" type="number" class="form-control" placeholder="Budget" autocomplete="off" step="0.1">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select name="currency" class="form-control" >
                                        <option value="" selected disabled>Select</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>
                          </div>
                          <div class="form-group  mt-2" >
                            <label>Description</label>
                            <textarea name="description" class="form-control"  rows="4" placeholder="Write Description" autocomplete="off"></textarea>
                          </div>

                          <div class="modal-footer  mt-2">
                            <button type="submit" class="btn btn-primary">Create Project</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>{{-- Create Project Modal --}}


    {{-- Edit Project Modal --}}
    <div id="edit" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Edit Project</h6>
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
                            <label>Project Name</label>
                            <input name="project_name"  type="text"  class="form-control" placeholder="Project name" autocomplete="off" id="project_name">
                        </div>
                        <div class="form-group">
                            <label>Client</label>
                            <select name="client" class="form-control  select2-selection" id="client_email">
                                <option value="" selected disabled>Select</option>
                                @foreach ($clients as $row)
                                    <option value="{{$row->client_id}}" >{{$row->full_name }} |  {{  $row->email}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-row mt-2">
                            <div class="col">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input name="start_date" type="date" class="form-control"  autocomplete="off" id="start_date">
                                </div>
                               
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input name="end_date" type="date" class="form-control"  autocomplete="off"  id="end_date">
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control select2-selection" id="status">
                                <option value="" selected disabled>Select </option>
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Finished">Finished</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                          </div>
                          <div class="form-row mt-2">
                            <div class="col">
                                <div class="form-group">
                                    <label>Budget</label>
                                    <input name="budget" type="number" class="form-control" placeholder="Budget" autocomplete="off" step="0.1" id="budget">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select name="currency" class="form-control" id="currency">
                                        <option value="" selected disabled>Select</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>
                          </div>
                          <div class="form-group  mt-2" >
                            <label>Description</label>
                            <textarea name="description" class="form-control"  rows="4" placeholder="Write Description" autocomplete="off" id="description"></textarea>
                          </div>


                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <button type="submit" class="btn btn-primary">Update Project</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->

            </div>
        </div><!-- MODAL DIALOG -->
    </div> {{-- Edit Project Modal --}}







    
    {{-- Invoice --}}
    {{-- <div id="invoice" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Invoice Item</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                
                    <div class="btn-list d-flex justify-content-between" >
                        <h4 class=" mb-4 align-self-center " id="invoice_project_name"> </h4>
                        <a href="javascript:viod();" data-backdrop="static" data-toggle="modal" data-target="#invoiceCreate" 
                            class="pull-right btn  btn-primary  btn-md d-inline addNewInvoice" id="addNewInvoice"><i class="ti-plus"></i> &nbsp;Add New Invoice</a>
                     </div>

                    <!-- ROW OPEN -->
						<div class="row mt-4">
							<div class="col-sm-12 col-lg-6 col-md-12 col-xl-4">
								<div class="card">
									<div class="row">
										<div class="col-4">
											<div class="circle-icon bg-primary text-center align-self-center box-primary-shadow">
												<img src="{{ asset('public/assets/images/svgs/circle.svg')}}" alt="img" class="card-img-absolute">
												<i class="zmdi zmdi-money fs-30  text-white mt-4"></i>
											</div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h3 class="mb-2 font-weight-normal mt-2" id="invoice_total_price"> </h3>
												<h5 class="font-weight-normal mb-0">Total Price</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-12 col-xl-4">
								<div class="card">
									<div class="row">
										<div class="col-4">
											<div class="card-img-absolute circle-icon bg-success align-items-center text-center box-success-shadow">
												<img src="{{ asset('public/assets/images/svgs/circle.svg')}}" alt="img" class="card-img-absolute">
												<i class="fa fa-credit-card fs-30 text-white mt-4"></i>
											</div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h3 class="mb-2 font-weight-normal mt-2" id="invoice_paid_amount"> </h3>
												<h5 class="font-weight-normal mb-0">Paid Amount</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-md-12 col-xl-4">
								<div class="card">
									<div class="row">
										<div class="col-4">
											<div class="card-img-absolute circle-icon bg-info align-items-center text-center box-info-shadow">
												<img src="{{ asset('public/assets/images/svgs/circle.svg')}}" alt="img" class="card-img-absolute">
												<i class="zmdi zmdi-globe-alt fs-30 text-white mt-4"></i>
											</div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h3 class="mb-2 font-weight-normal mt-2" id="invoice_currency"> </h3>
												<h5 class="font-weight-normal mb-0">Currency</h5>
											</div>
										</div>
									</div>
							   </div>
							</div>
						</div>
						<!-- ROW CLOSED -->

                    
                    <div class="table-responsive" >
                        <table class="table card-table table-vcenter text-nowrap  align-items-center table-invoice">
                            <thead class="thead-light">
                                <tr>
                                    <th>INV NUM</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Sent Date</th>
                                    <th>Deadline</th>
                                    <th>Create</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoice_table" >
                               
                            </tbody>
                        </table>
                    </div>


                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div> --}}
    {{-- Invoice --}}




@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Projects</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <script>
        $('#example').DataTable();
        $('.alert').hide();
        $('body').on('click', '#createNewProject', function() {
            $('#createform')[0].reset();
            $("#create .alert").css('display', 'none');
        });
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
                url: '{{ url("projects") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert").css('display', 'none');
                    $('.project_table').load(document.URL + ' .project_table');
                    $('#create').modal('hide');
                    $('#createform')[0].reset();
                    $('.select2-selection').change();
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
            url = '{{ url("projects") }}' + '/' + id + '/' + "edit";
            $.get(url, function(data) {
                $('#project_name').val(data.project_name);
                $('#client_email').val(data.client_id).trigger('change'); 
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#status').val(data.status).trigger('change');  
                $('#budget').val(data.budget);
                $('#currency').val(data.currency);
                $('#description').val(data.description);
                $('#hidden_id').val(data.project_id);
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
                url: '{{ url("project_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert1").css('display', 'none');
                    $('.project_table').load(document.URL + ' .project_table');
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
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.value) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
            $.ajax({
                    type:'DELETE',
                    url:'{{url("projects")}}/'+id,
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
                      'Partial Bill has related data first delete departments data',
                      'error'
                        )
                    }
                 });
                }
            })
              
        });
    </script>

    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('.select2-selection').select2({
                "width":"100%",
                "padding":"10px",
            });
        });
    </script>


    
    {{-- Invoice Code --}}
    <script>
        // Show invoice
        $('body').on('click', '.invoice', function() {
            var id = $(this).attr('data-id');
            var total_price = $(this).attr('data-total-price');
            var paidAmount=$(this).attr('data-paidAmount');
            var currency=$(this).attr('data-currency');

            $("#invoice_total_price").text(total_price);
            $("#invoice_paid_amount").text(paidAmount);
            $("#invoice_currency").text(currency);
            $('#addNewInvoice').attr('project_id', id);   
            var url="{{url('invoice_show')}}/"+id;
            $.get(url,function(data){
                if (data != '') {
                    Hdata = '';
                    for (var i = 0; i < data.length; i++) {
                        var dt = new Date(data[i].created_at);
                        Hdata += '<tr id="row_invoice'+data[i].id+'" >';
                        Hdata+=' <td>'+data[i].invoice_number+'</td><td>'+data[i].amount+'</td>';
                        if(data[i].status=="Unsent"){
                            Hdata+='<td><span  class="badge badge-warning mr-2 mb-2 ">'+data[i].status+'</span></td>';
                        }else if(data[i].status=="Paid"){
                            Hdata+='<td><span  class="badge badge-success mr-2 mb-2 ">'+data[i].status+'</span></td>';
                        }else{
                            Hdata+='<td><span class="badge badge-secondary mr-2 mb-2">'+data[i].status+'</span></td>';
                        }
                        if(data[i].sent_date==null){
                            Hdata+='<td class="text-danger" >Not Sent</td>';
                        }else{
                            Hdata+='<td>'+data[i].sent_date+'</td>';
                        }
                        Hdata+='<td>'+data[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+data[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoice_delete">Delete</a><a  data-id="'+data[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoice_edit">Edit</a>';
                        if(data[i].status!="Paid"){
                            Hdata+='<a  data-id="'+data[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoice_sent">Sent Invoice</a>';
                        }
                        Hdata+='</td></tr>';
                        $("#invoice_table ").html(Hdata);
                    }
                } else {
                    $("#invoice_table ").html('<tr><td> No Record Found </td></tr>');
                }
            });        
        });// Show invoice


        // click create button Invoice
        $('body').on('click', '.addNewInvoice', function() {
            $('.InvNum').load(document.URL + ' .InvNum');
            var project_id=$('#addNewInvoice').attr('project_id');  
            $('#project_id').val(project_id);           
        });// click create button Invoice



        
        // Delete invoice
        $('body').on('click','.invoice_delete',function(){  
            var id =$(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
                    $.ajax({
                            type:'DELETE',
                            url:'{{url("invoice")}}/'+id,
                            type:'Delete',
                            success:function(data){ 
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                $('#row_invoice'+id).hide(1500);
                            },
                            error:function(error){
                                Swal.fire(
                                'Faild!',
                                'Invoice has related data',
                                'error'
                                    )
                            }
                    });
                }
            })
              
        });// Delete invoice

        
        // Edit Invoice
        $('body').on('click', '.invoice_edit', function() {
            $(".alert").css('display', 'none');
            $('#editformInvoice')[0].reset();
            id = $(this).attr('data-id');
            url = '{{ url("invoice") }}' + '/' + id + '/' + "edit";
            $.get(url, function(data) {
                $('#invoice_number').val(data.invoice_number);
                $('#edit_project_id').val(data.project_id);
                $('#invoice_amount').val(data.amount);
                $('#invoice_status').val(data.status);
                $('#invoice_sent_date').val(data.sent_date);
                $('#invoice_deadline').val(data.deadline);
                $('#invoice_hidden_id').val(data.id);
            });
        }); // Edit Invoice


         // Edit  submit button Invoice
        $("#editformInvoice").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id=$('#edit_project_id').val(); 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("invoice_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert-invoiceItem").css('display', 'none');
                    $('#invoiceEdit').modal('hide');

                    $('#paidAmount').load(document.URL + ' #paidAmount');
                    $('.project_table').load(document.URL + ' .project_table');


                    var url="{{url('invoice_show')}}/"+id;
                    $.get(url,function(data){
                        if (data != '') {
                            Hdata = '';
                            for (var i = 0; i < data.length; i++) {
                                var dt = new Date(data[i].created_at);
                                Hdata += '<tr id="row_invoice'+data[i].id+'" >';
                                Hdata+=' <td>'+data[i].invoice_number+'</td><td>'+data[i].amount+'</td>';
                                
                                if(data[i].status=="Unsent"){
                                    Hdata+='<td><span  class="badge badge-warning mr-2 mb-2 ">'+data[i].status+'</span></td>';
                                }else if(data[i].status=="Paid"){
                                    Hdata+='<td><span  class="badge badge-success mr-2 mb-2 ">'+data[i].status+'</span></td>';
                                }else{
                                    Hdata+='<td><span class="badge badge-secondary mr-2 mb-2">'+data[i].status+'</span></td>';
                                }
                                if(data[i].sent_date==null){
                                    Hdata+='<td class="text-danger" >Not Sent</td>';
                                }else{
                                    Hdata+='<td>'+data[i].sent_date+'</td>';
                                }
                                Hdata+='<td>'+data[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+data[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoice_delete">Delete</a><a  data-id="'+data[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoice_edit">Edit</a>';
                                if(data[i].status!="Paid"){
                                    Hdata+='<a  data-id="'+data[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoice_sent">Sent Invoice</a>';
                                }
                                Hdata+='</td></tr>';
                                $("#invoice_table ").html(Hdata);
                            }
                        } else {
                            $("#invoice_table ").html('<tr><td> No Record Found </td></tr>');
                        }
                    });
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert-invoiceItem").find("ul").html('');
                    $(".alert-invoiceItem").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert-invoiceItem").find("ul").append('<li>' + value + '</li>');
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }); // Edit  submit button Invoice



        // Sent Invoice Item invoice
        $('body').on('click','.invoice_sent',function(){  
            var id =$(this).attr('data-id');
            var project_id=$('#addNewInvoice').attr('project_id');   
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#34c39f',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Sent invoice item!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
                    $.ajax({
                            type:'get',
                            url:'{{url("sentInvoice")}}/'+id,
                            type:'get',
                            success:function(data){ 
                                Swal.fire(
                                'Sent!',
                                'Your file has been sent.',
                                'success'
                                )
                                var url="{{url('invoice_show')}}/"+project_id;
                                $.get(url,function(data){
                                    if (data != '') {
                                        Hdata = '';
                                        for (var i = 0; i < data.length; i++) {
                                            var dt = new Date(data[i].created_at);
                                            Hdata += '<tr id="row_invoice'+data[i].id+'" >';
                                            Hdata+=' <td>'+data[i].invoice_number+'</td><td>'+data[i].amount+'</td>';
                                            if(data[i].status=="Unsent"){
                                                Hdata+='<td><span  class="badge badge-warning mr-2 mb-2 ">'+data[i].status+'</span></td>';
                                            }else if(data[i].status=="Paid"){
                                                Hdata+='<td><span  class="badge badge-success mr-2 mb-2 ">'+data[i].status+'</span></td>';
                                            }else{
                                                Hdata+='<td><span class="badge badge-secondary mr-2 mb-2">'+data[i].status+'</span></td>';
                                            }
                                            if(data[i].sent_date==null){
                                                Hdata+='<td class="text-danger" >Not Sent</td>';
                                            }else{
                                                Hdata+='<td>'+data[i].sent_date+'</td>';
                                            }
                                            Hdata+='<td>'+data[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+data[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoice_delete">Delete</a><a  data-id="'+data[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoice_edit">Edit</a>';
                                            if(data[i].status!="Paid"){
                                                Hdata+='<a  data-id="'+data[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoice_sent">Sent Invoice</a>';
                                            }
                                            Hdata+='</td></tr>';
                                            $("#invoice_table ").html(Hdata);
                                        }
                                    } else {
                                        $("#invoice_table ").html('<tr><td> No Record Found </td></tr>');
                                    }
                                });
                            },
                            error:function(error){
                                Swal.fire(
                                'Faild!',
                                'Invoice Item has related data',
                                'error'
                                    )
                            }
                    });
                }
            })
              
        });// Sent Invoice Item invoice


    </script>{{-- Invoice Code --}}




@endsection
