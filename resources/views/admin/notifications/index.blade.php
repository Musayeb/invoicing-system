@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
    <div class="card p-5 mb-5">
        <div class="btn-list btn-load">
            <button type="button" class="btn btn-gray btn-block readall"><span>Read All Notifications </span><span class="badge badge-danger ml-2">{{$count_unread}}</span></button>
        </div>

        <div class="mt-5"></div>
        <div class="row mt-5 mb-5 load">
           @foreach ($notifications as $row)
               @if ($row->status=="read")
                    <div class="col-sm-12 col-md-12 mb-4">
                        <div class="alert alert-success  d-flex" style="justify-content: space-between" role="alert">
                            <div>
                                <span class="alert-inner--icon"><i class="fe fe-check-circle mr-1"></i></span>
                                <span class="alert-inner--text">
                                    {{$row->description}}
                                    <p class="text-muted mt-1 ml-5" style="font-size:12px">
                                        @php
                                            $date=date_create($row->created_at);
                                            echo date_format($date,"Y-M-D");
                                        @endphp
                                         <span class="text-muted  ml-2" style="font-size:12px">
                                            @php
                                                $date=date_create($row->created_at);
                                                echo date_format($date,"h:i:s a");
                                            @endphp
                                        </span>
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
               @else
                    <div class="col-sm-12 col-md-12 mb-4" id="row{{ $row->id }}" >
                        <div class="alert alert-info   d-flex" style="justify-content: space-between" role="alert">
                            <div>
                                <span class="alert-inner--icon"><i class="fe fe-bell mr-1"></i></span>
                                <span class="alert-inner--text">
                                    {{$row->description}}
                                    <p class="text-muted mt-1 ml-5" style="font-size:12px">
                                        @php
                                            $date=date_create($row->created_at);
                                            echo date_format($date,"Y-M-D");
                                        @endphp
                                         <span class="text-muted  ml-2" style="font-size:12px">
                                            @php
                                                $date=date_create($row->created_at);
                                                echo date_format($date,"h:i:s a");
                                            @endphp
                                        </span>
                                    </p>
                                </span>
                            </div>
                            <a  data-id='{{$row->id}}' class="btn text-center text-success read">Read</a>
                        </div>
                    </div>
               @endif
           @endforeach
        </div>

        
    </div>


    


@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
@endsection

@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>


    <script>


    $('body').on('click','.read',function(){
        id = $(this).attr('data-id');
        url = '{{ url("notifications") }}' + '/' + id + '/' + "edit";
        $.get(url, function(data) {
            $('.load').load(document.URL + ' .load');
            return $.growl.notice({
                message: data.success,
                title: 'Success !',
            });
        });
    }); 
        

        
     // read all 
     $('body').on('click','.readall',function(){  
            Swal.fire({
                title: 'Are you sure?',
                text: "You want read all notifications !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#34c39f',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Read all notifications'
            }).then((result) => {
                if (result.value) {
					$('.readall').addClass('btn-loading');
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  
                    $.ajax({
                            type:'get',
                            url:'{{url("notifications_readAll")}}/',
                            type:'get',
                            success:function(data){ 
                                Swal.fire(
                                    'Sent!',
                                    'Your file has been sent.',
                                    'success'
                                    )

                                $('.readall').removeClass('btn-loading');
                                $('.btn-load').load(document.URL + ' .btn-load');
                                return $.growl.notice({
                                    message: data.success,
                                    title: 'Success !',
                                });
								
									
                            },
                            error:function(error){
                                $('.readall').load(document.URL + ' .readall');
                                Swal.fire(
                                'Faild!',
                                'Item has related data',
                                'error'
                                    )
                            }
                    });
                }
            })
              
        });  // read all 

    
    </script>
@endsection

