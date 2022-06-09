@extends('layouts.admin')

@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <!-- ROW -->
    {{-- <div class="row">
        <div class="col-xl-3 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class=""><span class="text-primary"><i
                                class="fe fe-file-text mr-2 fs-20 text-primary-shadow"></i></span>Total Price</h6>
                    <h3 class="text-dark counter mt-0 mb-3 number-font">7,896</h3>
                    <div class="progress h-1 mt-0 mb-2">
                        <div class="progress-bar progress-bar-striped bg-primary w-70" role="progressbar"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center"> <span class="text-muted">Project</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">7000</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Paid</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font2">7000</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Charges</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font3">896</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-6">
            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <h6 class=""><span class="text-success"><i
                                class="fe fe-users mr-2 fs-20 text-success-shadow"></i></span>Total Invoice</h6>
                    <h3 class="text-dark counter mt-0 mb-3 number-font">5</h3>
                    <div class="progress h-1 mt-0 mb-2">
                        <div class="progress-bar progress-bar-striped bg-success w-50" role="progressbar"></div>
                    </div>
                    <div class="row mt-4">

                        <div class="col text-center"> <span class="text-muted">Usent</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">0</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Sent</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">1</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Paid</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">4</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-6">
            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <h6 class=""><span class="text-danger"><i
                                class="fe fe-award mr-2 fs-20 text-danger-shadow"></i></span>Total Incomes</h6>
                    <h3 class="text-dark counter mt-0 mb-3 number-font">4</h3>
                    <div class="progress h-1 mt-0 mb-2">
                        <div class="progress-bar progress-bar-striped bg-danger w-60" role="progressbar"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center"> <span class="text-muted">Total Price</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">2000</h4>
                        </div>
               
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 col-lg-6">
            <div class="card overflow-hidden">
                <div class="card-body text-center">
                    <h6 class=""><span class="text-info"><i class="fe fe-tag mr-2 fs-20 text-info-shadow"></i></span>Total
                        Charges</h6>
                    <h3 class="text-dark counter mt-0 mb-3 number-font">1</h3>
                    <div class="progress h-1 mt-0 mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info w-40"
                            role="progressbar"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center"> <span class="text-muted">Usent</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">0</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Sent</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">0</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Paid</span>
                            <h4 class="font-weight-normal mt-2 mb-0 number-font1">1</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ROW -->


    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">

        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Project Information</h3>
                </div>
                <div class="card-body">

                    <div class="pd-20 p-4">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item listnoback">
                                        <b>Project Name</b> <a class="pull-right text-aqua text-primary"
                                            id="show_project_name">{{ $project->project_name }}</a>
                                    </li>

                                    <li class="list-group-item listnoback">
                                        <b>Start Date</b> <a class="pull-right text-aqua text-primary"
                                            id="show_start_date">{{ $project->start_date }}</a>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b>End Date</b> <a class="pull-right text-aqua text-primary"
                                            id="show_start_date">{{ $project->end_date }}</a>
                                    </li>


                                    <li class="list-group-item listnoback">
                                        <b>Budget</b> <a class="pull-right text-aqua text-primary"
                                            id="show_status">
											@if ($project->currency=='EUR')
											<span class="fa fa-eur" style="margin-right: 4px"></span>
										@elseif($project->currency=='GBP')
											<span class="fa fa-gbp" style="margin-right: 4px"></span>
										@else
											<span class="fa fa-dollar" style="margin-right: 4px"></span>
										@endif
										{{ $project->budget }}</a>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b>Status</b>
                                        <a class="pull-right text-aqua text-primary" id="show_status">
                                            @if ($project->status == 'Not Started')
                                                <span class="badge badge-warning  ml-2 "> {{ $project->status }} </span>
                                            @elseif($project->status=='In Progress')
                                                <span class="badge badge-info  ml-2 "> {{ $project->status }} </span>
                                            @elseif($project->status=='Finished')
                                                <span class="badge badge-success ml-2  "> {{ $project->status }} </span>
                                            @elseif($project->status=='Cancelled')
                                                <span class="badge badge-danger ml-2 "> {{ $project->status }} </span>
                                            @endif
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item listnoback">
                                        <b>Client Name</b> <a class="pull-right text-aqua text-primary"
                                            id="show_client_email">{{ $project->full_name }}</a>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b>Client Email</b> <a class="pull-right text-aqua text-primary"
                                            id="show_client_email">{{ $project->email }}</a>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b>Client phone number</b> <a class="pull-right text-aqua text-primary"
                                            id="show_client_email">{{ $project->phone }}</a>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b>Client Address</b> <a class="pull-right text-aqua text-primary"
                                            id="show_client_email">{{ $project->address }}</a>
                                    </li>


                                </ul>
                            </div>

                        </div>

                    </div><!-- modal-body -->

                </div>
            </div>
            <div class="card p-3">
				<div class="d-flex">
					<div class="col-lg-3">
                <div class="text-left">
					<h3 class="card-title ">Invoice Information</h3>
                </div>
			</div>
			<div class="col-lg-9">
				<div class=" float-right">
                    <a href="{{ url('invoices') }}/{{ $project->project_id }}/{{ Helper::invNum() }}"><button
                            class="btn btn-primary">+ Generate Invoice</button></a>
                </div>
			</div>
				
			</div>
                <div class="card-header p-0">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#tab-61" class="active show" data-toggle="tab"
                                            class="">Invoice</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="border-0">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-61">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap  align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Invoice No</th>
                                                <th>Project Name</th>
                                                <th>Author</th>
                                                <th>ُStatus</th>
                                                <th>Registred Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter=1; @endphp
                                            @foreach ($invoices as $inv)
                                                <tr id="rowsss{{$inv->invoice_id}}">
                                                    <td>{{ $counter++ }}</td>
                                                    <td>#{{ $inv->invoice_number }}</td>
                                                    <td>{{ $inv->project_name }}</td>
                                                    <td>{{ $inv->email }}</td>
                                                    <td>
                                                    @if ($inv->status=="Pending")
                                                    <span class="badge badge-warning">{{$inv->status}}</span>
                                                    @elseif($inv->status=="Paid")
                                                    <span class="badge badge-success">{{$inv->status}}</span>
                                                    @elseif($inv->status=="Sent")    
                                                    <span class="badge badge-primary">{{$inv->status}}</span>
                                                    @endif

                                                    </td>
                                                    <td>{{ $inv->created_at }}</td>
                                                    <td>
                                                        <a data-target="#charges"
                                                            data-invoice="{{ $inv->invoice_number }}"
                                                            data-date="{{ $inv->created_at }}"
                                                            data-invoice_id="{{ $inv->invoice_id }}" data-toggle="modal"
                                                            class="btn btn-success btn-sm text-white addcharge mr-2">Add
                                                            Charges</a>
                                                        
                                                        @if ($inv->status=="Sent" || $inv->status=="Paid")
                                                          <a href="{{ url( $inv->file_path ) }}" target="_blank"
                                                             class="btn btn-success btn-sm text-white mr-2">Download</a>
                                                         @endif 
                                                             
                                                              
                                                            @if ($inv->status=="Pending"||$inv->status=="Sent")
                                                            <button id="button{{ $inv->invoice_id }}"
                                                            data-invoice="{{ $inv->invoice_id }}" class="btn btn-blue btn-sm text-white mr-2 send_invoice">Send Invoice</button>
                                                            @endif 
                                                            
                                                        <a data-id="{{ $inv->invoice_id }}"
                                                            class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                                                     </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->



    </div>
    <!-- ROW-1 CLOSED -->


    <div id="addcharge" class="modal fade" style="z-index:100000">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add Charges to invoice</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert alert12 alert-danger">
                        <ul id="error"></ul>
                    </div>

                    <form method="post" id="chargeform">

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <input type="hidden" name="invoice_id" class="invoice_id">

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>
	<div id="editchargeModal" class="modal fade" style="z-index:100000">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Edit Charges to invoice</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert alert13 alert-danger">
                        <ul id="error"></ul>
                    </div>

                    <form method="post" id="chargeformedit">

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" id="description">
                        </div>
                        <input type="hidden" name="invoice__info_id" class="invoice__info_id">

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control" id="amount">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>
    <div id="charges" class="modal fade">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h6 class="modal-title">Add charges to invoice</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert alert1 alert-danger">
                        <ul id="error"></ul>
                    </div>

                    <button class="btn btn-blue float-right mr-1" data-toggle="modal" data-target="#addcharge">Add
                        charges</button>
                    <br><br>
                    <div class="row pl-2 pr-2">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label>Invoice #<strong id="inv_no"></strong></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group float-right">
                                <label>Date: <strong id="inv_date"></strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="row p-4 table-sm table">
                        <table class="printablea4" cellspacing="0" cellpadding="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>QTY</th>
                                    <th>Amount</th>
                                    <th>Total</th>
									<th>Author</th>
									<th>Action</th>

                                </tr>
                            </thead>
							<tbody id="tb">
								
							</tbody>
                        </table>
                    </div>

                    <div class="d-flex">
                        <div style="width:50%">


                        </div>
                        <div style="width:50%">
                            <table align="" class="printablea4" style="width: 40%; float: right;">
                                <tbody>
                                    <tr>
                                        <th>Total</th>
                                        <td class="total"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

        </div><!-- modal-body -->
    </div>
    </div><!-- MODAL DIALOG -->


@endsection

@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Project</li>
    <li class="breadcrumb-item active" aria-current="page">{{ $project->project_name }}</li>

@endsection


@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>


    <script>
        $('.alert').hide();
        // click submit button Invoice
        $('body').on('click', '.addcharge', function() {
            $('#inv_no').html($(this).attr('data-invoice'));
            $('#inv_date').html($(this).attr('data-date'));
            $('.invoice_id').val($(this).attr('data-invoice_id'));
			datainfo($(this).attr('data-invoice_id'));
        });
		function datainfo(invoice) {
			var htmldata="";
			var total=[];
			var totals="";	
	
			var cout=1;
			$.ajax({
                url:'{{ url("invoice_info")}}/'+invoice,
                type: 'get',
                success: function (data) {
                    $('#hdata').html("");
                    if(data !=""){
                        for (let i = 0; i < data.length; i++) {
                            htmldata+='<tr id="row'+data[i].invoice_info_id+'"><td >'+ cout++ +'</td><td >'+ data[i].description + '</td>\
                            <td>'+ data[i].qty+'</td>\
                            <td>'+ data[i].amount+'</td>\
                            <td>'+ data[i].amount*data[i].qty+'</td>\
							<td>'+ data[i].email+'</td>\
							<td><a class="btn btn-danger btn-sm text-white mr-2 deletecharges" data-id="'+data[i].invoice_info_id+'">Delete</a>\
								<a data-id="'+data[i].invoice_info_id+'" data-toggle="modal"data-target="#editchargeModal" class="btn btn-info btn-sm text-white mr-2 editcharges">Edit</a>\
								</td>';
							;	
                            $('#tb').html(htmldata);
							total.push(data[i].amount*data[i].qty);
							$('.total').html(total.reduce((a, b) => a + b, 0));
                        }
                        }else{
                            $('#tb').html('<tr><td>No record data found</td></tr>');
							$('.total').html(0);

						}
                },
            });

		}
    </script>
    <script>
        $("#chargeform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '}});
            $.ajax({
                url: "{{ url('invoice_info') }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    $(".alert12").css('display', 'none');
                         $('#addcharge').modal('hide');
                    $('#chargeform')[0].reset();
					datainfo($('.invoice_id').val());
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert12").find("ul").html('');
                    $(".alert12").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert12").find("ul").append('<li>' + value + '</li>');
                    });

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

		$('body').on('click','.editcharges',function(){
			
			$.ajax({
                url:'{{ url("invoice_info")}}/'+$(this).attr('data-id')+'/edit',
                type: 'get',
                success: function (data) {
					$('#description').val(data.description);
					$('#quantity').val(data.qty);
					$('#amount').val(data.amount);
					$('.invoice__info_id').val(data.invoice_info_id);
                },
            });


		});
		$("#chargeformedit").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '}});
			
            $.ajax({
                url: "{{ url('invoice_info_update') }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    $(".alert12").css('display', 'none');
                    $('#editchargeModal').modal('hide');
                    $('#chargeformedit')[0].reset();
					datainfo($('.invoice_id').val());

					return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert12").find("ul").html('');
                    $(".alert12").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert12").find("ul").append('<li>' + value + '</li>');
                    });

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
		$('body').on('click', '.delete', function() {
			var row=$(this).attr('data-id');
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
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '}});
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ url("invoice") }}/' + $(this).attr('data-id'),
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )
                            $('#rowsss'+row).hide(1500);
                        },
                        error: function(error) {
                            Swal.fire(
                                'Faild!',
                                'Server Error',
                                'error'
                            )
                        }
                    });
                }
            })

        });

        $('body').on('click','.send_invoice',function(){
            var incoice=$(this).attr('data-invoice');
        var r = confirm("Please confirm your request !");
            if (r == true) {
                $('#button'+incoice).html('Sending....');
            $.ajax({
                url:'{{ url("sendInvoice")}}/'+incoice,
                type: 'get',
                  success: function (data) {
                  $('#button'+incoice).html('Send Invoice');
                   
                  $('.card-table').load(document.URL +  ' .card-table');

                  return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
            });
            } else {
            }

        });
    </script>
@endsection
