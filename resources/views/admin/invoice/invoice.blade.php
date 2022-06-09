

@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-selection{
           background:#f5f6fa !important;
       }
       #invoiceItem_table{
           background: white !important;
       }
   </style>


@endsection
@section('content')
    <div class="card p-3">
        <div class="btn-list ">
                <a href="javascript:viod();" data-backdrop="static" data-toggle="modal" data-target="#create"
                    class="pull-right btn btn-primary d-inline click-create"><i class="ti-plus"></i> &nbsp;Add New Invoice</a>
        </div>

        <div class="mt-5 table-responsive">
            <table class="table table-striped table-bordered table-sm text-nowrap w-100 dataTable no-footer main-table" id="example" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Num</th>
                        {{-- <th>Client Email</th> --}}
                        <th>Project Name</th>
                        <th>Currency</th>
                        <th>Total Price</th>
                        <th>Paid Amount</th>
                        <th>Status</th>
                        {{-- <th>Create</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1; @endphp
                    @foreach ($invoice as $row)

                        <tr id="row{{ $row->id }}" class="text-center">
                            <td> {{$counter++}} </td>
                            <td> {{$row->invoice_number}} </td>
                            {{-- <td> <?php echo Helper::getCustomer($row->client_id)->email; ?> </td> --}}
                            <td > <?php echo Helper::getProject($row->project_id)->project_name; ?> </td>
                            <td class="text-info font-weight-bold">  $ {{$row->currency}} </td>
                            <td> {{$row->total_price}} </td>
                            <td> 0  </td>
                            <td>
                                @if ($row->status=='Unpaid')
                                    <span class="badge badge-warning mr-2 mb-2 "> Unpaid</span>
                                @elseif($row->status=='Partially paid')
                                    <span class="badge badge-info mr-2 mb-2 ">  Partially paid </span>
                                @elseif($row->status=='Paid')
                                    <span class="badge badge-success mr-2 mb-2 ">  Paid</span>     
                                @endif
                            </td>
                            {{-- <td> {{$row->created_at}} </td> --}}
                            <td>
                                <a  data-id="{{$row->id}}"  data-toggle="modal" data-target="#show"  class="btn btn-success btn-sm text-white mr-2 show">Show</a>
                                <a  data-id="{{$row->id}}"  class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                                <a  data-id="{{$row->id}}"  data-toggle="modal" data-target="#edit"  class="btn btn-info btn-sm text-white mr-2 edit">Edit</a>
                                <a  data-id="{{$row->id}}" data-client="<?php echo Helper::getCustomer($row->client_id)->id; ?>" data-total-price="{{$row->total_price}}" data-currency="{{$row->currency}}" data-project-name="<?php echo Helper::getProject($row->project_id)->project_name; ?> " data-toggle="modal" data-target="#invoiceItem"  class="btn btn-info btn-sm text-white mr-2 invoiceItem">Invoice Item</a>
                            </td>   
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div id="create" class="modal fade create">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add Invoice</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert  alert-danger">
                        <ul id="error"></ul>
                    </div>

                    <form method="post" id="createform">
                        <div class="form-group InvNum">
                            <label>Invoice Number</label>
                            <input name="invoice_number" readonly  type="text"  class="form-control" value="INV-00<?php echo Helper::invNum() ?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Client Email</label>
                            <select name="client_email" class="form-control  select2-selection " id="select_client_email">
                                <option value="" selected disabled>Select Client Email</option>
                                @foreach ($clients as $row)
                                    <option value="{{$row->id}}" >{{$row->email}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Project Name</label>
                            <select name="project_name" class="form-control select2-selection project_name select_projects">
                                <option value="" selected disabled>No Record Found</option>
                            </select>
                        </div>
                          
                        <div class="form-group">
                            <label>Total Price</label>
                            <input name="total_price"  type="number"  class="form-control" placeholder="Total price" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <input name="status" readonly  type="text"  class="form-control" value="Unpaid" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Currency</label>
                            <select name="currency" class="form-control" >
                                <option value="" selected disabled>Select Currency</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                            </select>
                        </div>

                        <div class="modal-footer  mt-2">
                            <button type="submit" class="btn btn-primary">Create Invoice</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>


    {{-- Edit Modal  --}}
    <div id="edit" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Edit Invoice</h6>
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
                            <label>Invoice Number</label>
                            <input name="invoice_number" readonly  type="text"  class="form-control" value="INV-0012" autocomplete="off" id="invoice_number">
                        </div>

                        <div class="form-group">
                            <label>Client Email</label>
                            <select name="client_email" class="form-control  select2-selection "  id="client_email">
                                <option value="" selected disabled>Select Client Email</option>
                                @foreach ($clients as $row)
                                    <option value="{{$row->id}}" >{{$row->email}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Project Name</label>
                            <select name="project_name" class="form-control select2-selection project_name" id="project_name">
                                <option value="" selected disabled>No Record Found</option>
                            </select>
                            <input type="hidden" value="" name="" id="project_id_hidden">
                        </div>
                          
                        <div class="form-group">
                            <label>Total Price</label>
                            <input name="total_price"  type="number"  class="form-control" placeholder="Total price" autocomplete="off" id="total_price">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="" selected disabled>Select Status</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Partially paid">Partially paid</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Currency</label>
                            <select name="currency" class="form-control " id="currency">
                                <option value="" selected disabled>Select Currency</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                            </select>
                        </div>

                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <button type="submit" class="btn btn-primary">Update Invoice</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->

            </div>
        </div><!-- MODAL DIALOG -->
    </div>

    
   
    {{-- Show Modal --}}
    <div id="show" class="modal fade" style="z-index:100000">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Show </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20 p-5" id="divtoprint">
                    <h6 class="card-title mb-4">Invoice Items</h6>
                    <!-- ROW -->
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-order">
                                        <h6 class="mb-2">Total Invoice Item</h6>
                                        <h2 class="text-right "><i class="mdi mdi-account-multiple icon-size float-left text-primary text-primary-shadow"></i><span>3,672</span></h2>
                                        <p class="mb-0">Total Price<span class="float-right">500</span></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="card-widget">
                                        <h6 class="mb-2">Total Sent Invoice Item</h6>
                                        <h2 class="text-right"><i class="mdi mdi-cube icon-size float-left text-success text-success-shadow"></i><span>$89,265</span></h2>
                                        <p class="mb-0">Total Price<span class="float-right">$7,893</span></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-widget">
                                        <h6 class="mb-2">Total Proccess Invoice</h6>
                                        <h2 class="text-right"><i class="icon-size mdi mdi-poll-box  float-left text-info text-info-shadow"></i><span>$23,987</span></h2>
                                        <p class="mb-0">Total Price<span class="float-right">$4,678</span></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                    </div>
                    <!-- ROW END -->

                        <h6 class="card-title">Invoice Information</h6>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item listnoback">
                                        <b>Invoice Number</b> <a class="pull-right text-aqua text-primary" id="show_invoice_number"> </a>
                                    </li>
                                    <li class="list-group-item listnoback">
                                        <b>Client Email</b> <a class="pull-right text-aqua text-primary" id="show_client_email"> </a>
                                        <input type="hidden" id="show_client_email_input">
                                    </li>
                
                                    <li class="list-group-item listnoback">
                                        <b>Project Name</b> <a class="pull-right text-aqua text-primary" id="show_project_name"> </a>
                                    </li>
                
                                    
                                    <li class="list-group-item listnoback">
                                        <b>Currency</b> <a class="pull-right text-aqua text-primary" id="show_currency"> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item listnoback">
                                        <b>Total Price</b> <a class="pull-right text-aqua  text-primary" id="show_total_price"> </a>
                                    </li>
        
                                    <li class="list-group-item listnoback">
                                        <b>Paid Amount</b> <a class="pull-right text-aqua  text-primary" id="show_paid_amount">0</a>
                                    </li>
        
                                    <li class="list-group-item listnoback">
                                        <b>Status</b> <a class="pull-right text-aqua  text-primary" id="show_status"> </a>
                                    </li>
        
                                    <li class="list-group-item listnoback">
                                        <b>Create Invoice</b> <a class="pull-right text-aqua text-primary" id="show_created_at"> </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </div>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>





    {{-- Invoice Item  --}}
    <div id="invoiceItem" class="modal fade">
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
                            class="pull-right btn  btn-primary  btn-md d-inline click-create" id="invoiceItemCreate"><i class="ti-plus"></i> &nbsp;Add New Invoice Item</a>
                     </div>

                     {{-- <ul class="list-group list-group-unbordered my-4">
                        <li class="list-group-item listnoback">
                            <b>Total Price</b> <a class="pull-right text-aqua  text-primary"  id="invoice_total_price">2000</a>
                        </li>

                        <li class="list-group-item listnoback">
                            <b>Paid Amount</b> <a class="pull-right text-aqua  text-primary" id="invoice_paid_amount" > </a>
                        </li>

                        <li class="list-group-item listnoback">
                            <b>Currency</b> <a class="pull-right text-aqua  text-primary" id="invoice_currency">USD</a>
                        </li>
                    </ul> --}}

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
												<h3 class="mb-2 font-weight-normal mt-2" id="invoice_total_price">17,533</h3>
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
												<h3 class="mb-2 font-weight-normal mt-2" id="invoice_paid_amount">10,257</h3>
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
												<h3 class="mb-2 font-weight-normal mt-2" id="invoice_currency">87</h3>
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
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Sent Date</th>
                                    <th>Deadline</th>
                                    <th>Create Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceItem_table" >
                               
                            </tbody>
                        </table>
                    </div>



                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>{{-- Invoice Item  --}}





    {{-- Invoice Item Create --}}
    <div id="invoiceCreate" class="modal fade invoiceCreate">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add Invoice Item</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert  alert-danger">
                        <ul id="error" ></ul>
                    </div>
                    
                    <form method="post" id="createformInvoiceItem">
                        <div class="form-group">
                            <input name="invoice_id"   type="hidden"  class="form-control" placeholder="Invoice Id"  autocomplete="off" id="invoiceItem_id">
                            <input name="client_id"   type="hidden"  class="form-control" placeholder="client Id"  autocomplete="off" id="invoiceItem_client">

                            <label>Invoice Item Amount</label>
                            <input name="InvoiceItem_amount"  type="number"  class="form-control"  placeholder="Invoice Item amount" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <input name="status" readonly  type="text"  class="form-control" value="Unsent" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Deadline</label>
                            <input name="deadline" type="date"  class="form-control" placeholder="Deadline" autocomplete="off">
                        </div>

                        <div class="modal-footer  mt-2">
                            <button type="submit" class="btn btn-primary">Create Invoice Item</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>{{-- Invoice Item Create --}}



    
    {{-- Invoice Item Edit --}}
    <div id="invoiceEdit" class="modal fade invoiceEdit">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Edit Invoice Item</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert-invoiceItem alert  alert-danger">
                        <ul id="error"></ul>
                    </div>
                    
                    <form method="post"  id="editformInvoiceItem">
                        <div class="form-group">
                            <input name="edit_invoice_id"   type="hidden"  class="form-control" placeholder="Invoice Id"  autocomplete="off" id="edit_invoiceItem_id">
                            <input name="edit_client_id"   type="hidden"  class="form-control" placeholder="client Id"  autocomplete="off" id="edit_invoiceItem_client">

                            <label>Invoice Item Amount</label>
                            <input name="invoiceItem_amount"  type="number"  class="form-control"  placeholder="Invoice Item amount" autocomplete="off" id="invoiceItem_amount">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control " id="invoiceItem_status">
                                <option value="" selected disabled>Select Status</option>
                                <option value="Sent">Sent</option>
                                <option value="Unsent">Unsent</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sent Date</label>
                            <input name="sent_date"  type="date"  class="form-control"  autocomplete="off" id="sent_date">
                        </div>

                        <div class="form-group">
                            <label>Deadline</label>
                            <input name="deadline" type="date"  class="form-control" placeholder="Deadline" autocomplete="off" id="deadline">
                        </div>

                        <div class="modal-footer  mt-2">
                            <input type="hidden" name="invvoiceitem_hidden_id" id="invvoiceitem_hidden_id">
                            <button type="submit" class="btn btn-primary">Update Invoice Item</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>{{-- Invoice Item Edit --}}



@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#example').DataTable();
        $('.alert').hide();
    </script>


    <script>

        $('body').on('click', '.click-create', function() {
            $('#createform')[0].reset();
        })

        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("invoice") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert").css('display', 'none');
                    $('.main-table').load(document.URL + ' .main-table');
                    $('#create').modal('hide');
                    $('#createform')[0].reset();
                    $('.select2-selection').change();
                    $('.InvNum').load(document.URL + ' .InvNum');
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
            url = '{{ url("invoice") }}' + '/' + id + '/' + "edit";
            $.get(url, function(data) {
                $('#invoice_number	').val(data.invoice_number	);
                $('#client_email').val(data.client_id).trigger('change');
                $('#project_name').val(data.project_id).trigger('change');
                $('#total_price').val(data.total_price); 
                $('#status').val(data.status);  
                $('#currency').val(data.currency);
                $('#hidden_id').val(data.id);
                $('#project_id_hidden').val(data.project_id);
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
                url: '{{ url("invoice_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert1").css('display', 'none');
                    $('.main-table').load(document.URL + ' .main-table');
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



        $('body').on('click', '.show', function() {
            id = $(this).attr('data-id');
            url = '{{ url("invoice") }}' + '/' + id + '/' + "edit";
            $.get(url, function(data) {
                $('#show_invoice_number	').text(data.invoice_number	);
                url_client = '{{ url("invoice_email") }}' + '/' + data.client_id ;
                $.get(url_client, function(data_email) {
                    $('#show_client_email').text(data_email.email);
                });
            
                // $('#show_project_name').text(data.project_id);
                $('#show_client_email_input').val(data.project_id);
                var url="{{url('projects_show')}}/"+data.client_id;
                $.get(url,function(mydata){
                    var project_id=$("#show_client_email_input").val();
                    for (var i = 0; i < mydata.length; i++) {
                        if(project_id==mydata[i].id){
                            $('#show_project_name').text(mydata[i].project_name);
                            
                        }
                    }
                })

                $('#show_total_price').text(data.total_price);
                var status='';
                if(data.status=='Paid'){
                     status="<span class='badge badge-success'>"+data.status+"</span>";
                }else if(data.status=='Partially paid'){
                     status="<span class='badge badge-info'>"+data.status+"</span>";
                }else{
                     status="<span class='badge badge-warning'>"+data.status+"</span>";
                }
                $('#show_status').html(status);  
                $('#show_currency').text(data.currency);
                $('#show_created_at').text(data.created_at);
                
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
                    url:'{{url("invoice")}}/'+id,
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
                      'Invoice has related data first delete departments data',
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

    {{-- Get Project Name --}}
    <script>
        $("#select_client_email").change(function () {
            var id=($(this).val());
            var url="{{url('projects_show')}}/"+id;
            var Hdata="";
            $.get(url,function(data){
                 if (data != '') {
                        Hdata = '<option value="" selected disabled>Select Project</option>';
                        for (var i = 0; i < data.length; i++) {
                            Hdata += '<option value="' + data[i].id + '">' + data[i]
                                .project_name  + '</option>';
                            $(".select_projects").html(Hdata);
                        }
                    } else {
                        $(".select_projects").html(
                            '<option value="" selected disabled>No Record Found</option>');
                    }
            })
            
        });

        $("#client_email").change(function () {
            var id=($(this).val());
            var url="{{url('projects_show')}}/"+id;
            var Hdata="";
            $.get(url,function(data){
                 if (data != '') {
                        Hdata = '<option value="" selected  disabled>Select Project</option>';
                        var project_id=$("#project_id_hidden").val();
                        for (var i = 0; i < data.length; i++) {
                            if(data[i].id==project_id){
                                Hdata += '<option  selected value="' + data[i].id + '">' + data[i]
                                        .project_name  + '</option>';
                                        $("#project_name ").html(Hdata);
                            }else{
                                Hdata += '<option  value="' + data[i].id + '">' + data[i]
                                        .project_name  + '</option>';
                                        $("#project_name ").html(Hdata);
                            }
                        
                        }
                    } else {
                        $("#project_name ").html(
                            '<option value="" selected disabled>No Record Found</option>');
                    }
            })
            
        });
    </script>




    {{-- Invoice Item Code --}}
    <script>

         $('body').on('click', '.invoiceItem', function() {
            $('#createformInvoiceItem')[0].reset();

            var id = $(this).attr('data-id');
            var client_id=$(this).attr('data-client');
            var project_name=$(this).attr("data-project-name");
            $('#invoiceItemCreate').attr('invoice_id', id);
            $('#invoiceItemCreate').attr('client_id', client_id);
            $('#invoice_project_name').text(project_name);

            var total_price = $(this).attr('data-total-price');
            var currency=$(this).attr('data-currency');
            $("#invoice_total_price").text(total_price);
            $("#invoice_currency").text(currency);
            
            var url="{{url('invoiceItem_show')}}/"+id;
            $.get(url,function(data){
                if (data != '') {
                    Hdata = '';
                    for (var i = 0; i < data.length; i++) {
                        var dt = new Date(data[i].created_at);
                        Hdata += '<tr id="row_invoiceItem'+data[i].id+'" >';
                        Hdata+=' <td>'+data[i].amount+'</td><td>';
                        if(data[i].status=="Unsent"){
                            Hdata+='<span  class="badge badge-warning mr-2 mb-2 ">'+data[i].status+'</span></td>';
                        }else{
                            Hdata+='<span class="badge badge-secondary mr-2 mb-2">'+data[i].status+'</span></td>';
                        }
                        if(data[i].sent_date==null){
                            Hdata+='<td class="text-danger" >Not Sent</td>';
                        }else{
                            Hdata+='<td>'+data[i].sent_date+'</td>';
                        }
                        Hdata+='<td>'+data[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+data[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoiceItem_delete">Delete</a><a  data-id="'+data[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoiceItem_edit">Edit</a><a  data-id="'+data[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoiceItem_sent">Sent Invoice Item</a></td></tr>'
                        $("#invoiceItem_table ").html(Hdata);
                    }
                } else {
                    $("#invoiceItem_table ").html('<tr><td> No Record Found </td></tr>');
                }
            });
        });


        $('#invoiceItemCreate').on('click',function(){
            var invoice_id=$(this).attr('invoice_id');
            var client_id=$(this).attr('client_id');
            $("#invoiceItem_id").val(invoice_id);
            $("#invoiceItem_client").val(client_id);
            $(".alert").css('display', 'none');
        });

        $("#createformInvoiceItem").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id=$('#invoiceItemCreate').attr('invoice_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("invoiceItem") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert").css('display', 'none');
                    $('#invoiceCreate').modal('hide');
                    $('#createformInvoiceItem')[0].reset();
                    var url="{{url('invoiceItem_show')}}/"+id;
                    $.get(url,function(mydata){
                        if (mydata != '') {
                            Hdata = '';
                            for (var i = 0; i < mydata.length; i++) {
                                var dt = new Date(mydata[i].created_at);
                                Hdata += '<tr id="row_invoiceItem'+mydata[i].id+'" >';
                                Hdata+=' <td>'+mydata[i].amount+'</td><td>';
                                if(mydata[i].status=="Unsent"){
                                    Hdata+='<span  class="badge badge-warning mr-2 mb-2 ">'+mydata[i].status+'</span></td>';
                                }else{
                                    Hdata+='<span class="badge badge-secondary mr-2 mb-2">'+mydata[i].status+'</span></td>';
                                }
                                if(mydata[i].sent_date==null){
                                    Hdata+='<td class="text-danger" >Not Sent</td>';
                                }else{
                                    Hdata+='<td>'+mydata[i].sent_date+'</td>';
                                }
                                Hdata+='<td>'+mydata[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+mydata[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoiceItem_delete">Delete</a><a  data-id="'+mydata[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoiceItem_edit">Edit</a><a  data-id="'+mydata[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoiceItem_sent">Sent Invoice Item</a></td></tr>';
                                $("#invoiceItem_table ").html(Hdata);
                            }
                        } else {
                            $("#invoiceItem_table ").html('<tr><td> No Record Found </td></tr>');
                        }
                    });
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





        // Edit Invoice Item
        $('body').on('click', '.invoiceItem_edit', function() {

            $(".alert").css('display', 'none');
            $('#editformInvoiceItem')[0].reset();
            var invoice_id=$("#invoiceItemCreate").attr('invoice_id');
            var client_id=$("#invoiceItemCreate").attr('client_id');
            $("#edit_invoiceItem_id").val(invoice_id);
            $("#edit_invoiceItem_client").val(client_id);

            id = $(this).attr('data-id');
            url = '{{ url("invoiceItem") }}' + '/' + id + '/' + "edit";
            $.get(url, function(data) {
                $('#invoiceItem_amount').val(data.amount);
                $('#invoiceItem_status').val(data.status);
                $('#sent_date').val(data.sent_date);
                $('#deadline').val(data.deadline); 
                $('#invvoiceitem_hidden_id').val(data.id);
                console.log(data);
            });
        });


        $("#editformInvoiceItem").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id=$('#invoiceItemCreate').attr('invoice_id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("invoiceItem_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert-invoiceItem").css('display', 'none');
                    $('#invoiceEdit').modal('hide');
                    // $('#editformInvoiceItem')[0].reset();


                    var url="{{url('invoiceItem_show')}}/"+id;
                    $.get(url,function(mydata){
                        if (mydata != '') {
                            Hdata = '';
                            for (var i = 0; i < mydata.length; i++) {
                                var dt = new Date(mydata[i].created_at);
                                Hdata += '<tr id="row_invoiceItem'+mydata[i].id+'" >';
                                Hdata+=' <td>'+mydata[i].amount+'</td><td>';
                                if(mydata[i].status=="Unsent"){
                                    Hdata+='<span  class="badge badge-warning mr-2 mb-2 ">'+mydata[i].status+'</span></td>';
                                }else{
                                    Hdata+='<span class="badge badge-secondary mr-2 mb-2">'+mydata[i].status+'</span></td>';
                                }
                                if(mydata[i].sent_date==null){
                                    Hdata+='<td class="text-danger" >Not Sent</td>';
                                }else{
                                    Hdata+='<td>'+mydata[i].sent_date+'</td>';
                                }
                                Hdata+='<td>'+mydata[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+mydata[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoiceItem_delete">Delete</a><a  data-id="'+mydata[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoiceItem_edit">Edit</a><a  data-id="'+mydata[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoiceItem_sent">Sent Invoice Item</a></td></tr>';
                                $("#invoiceItem_table ").html(Hdata);
                            }
                        } else {
                            $("#invoiceItem_table ").html('<tr><td> No Record Found </td></tr>');
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
        });




        // Delete invoice Item
        $('body').on('click','.invoiceItem_delete',function(){  
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
                            url:'{{url("invoiceItem")}}/'+id,
                            type:'Delete',
                            success:function(data){ 
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                $('#row_invoiceItem'+id).hide(1500);
                            },
                            error:function(error){
                                Swal.fire(
                                'Faild!',
                                'Invoice has related data first delete departments data',
                                'error'
                                    )
                            }
                    });
                }
            })
              
        });








        // Sent Invoice Item invoice Item
        $('body').on('click','.invoiceItem_sent',function(){  
            var id =$(this).attr('data-id');
            var invoice_id=$('#invoiceItemCreate').attr('invoice_id');
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
                            url:'{{url("sentInvoiceItem")}}/'+id,
                            type:'get',
                            success:function(data){ 
                                Swal.fire(
                                'Sent!',
                                'Your file has been sent.',
                                'success'
                                )

                                var url="{{url('invoiceItem_show')}}/"+invoice_id;
                                $.get(url,function(mydata){
                                    if (mydata != '') {
                                        Hdata = '';
                                        for (var i = 0; i < mydata.length; i++) {
                                            var dt = new Date(mydata[i].created_at);
                                            Hdata += '<tr id="row_invoiceItem'+mydata[i].id+'" >';
                                            Hdata+=' <td>'+mydata[i].amount+'</td><td>';
                                            if(mydata[i].status=="Unsent"){
                                                Hdata+='<span  class="badge badge-warning mr-2 mb-2 ">'+mydata[i].status+'</span></td>';
                                            }else{
                                                Hdata+='<span class="badge badge-secondary mr-2 mb-2">'+mydata[i].status+'</span></td>';
                                            }
                                            if(mydata[i].sent_date==null){
                                                Hdata+='<td class="text-danger" >Not Sent</td>';
                                            }else{
                                                Hdata+='<td>'+mydata[i].sent_date+'</td>';
                                            }
                                            Hdata+='<td>'+mydata[i].deadline+'</td><td class="text-primary">'+dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+'</td><td><a  data-id="'+mydata[i].id+'"  class="btn btn-danger btn-sm text-white mr-2 invoiceItem_delete">Delete</a><a  data-id="'+mydata[i].id+'"  data-toggle="modal" data-target="#invoiceEdit"  class="btn btn-info btn-sm text-white mr-2 invoiceItem_edit">Edit</a><a  data-id="'+mydata[i].id+'"   data-toggle="modal" data-target="# "  class="btn btn-secondary btn-sm text-white mr-2 invoiceItem_sent">Sent Invoice Item</a></td></tr>';
                                            $("#invoiceItem_table ").html(Hdata);
                                        }
                                    } else {
                                        $("#invoiceItem_table ").html('<tr><td> No Record Found </td></tr>');
                                    }
                                });


                                $('#row_invoiceItem'+id).hide(1500);

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
              
        });

    </script>



@endsection
