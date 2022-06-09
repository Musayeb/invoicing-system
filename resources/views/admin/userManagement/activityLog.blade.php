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
        <div class="table-responsive table-md mt-5">
            <table class="table mb-0  table-striped  text-nowrap w-100 dataTable no-footer" id="example">
                <thead class="thead-light">
                    <tr>
                        <th  class="text-center">#</th>
                        <th class="text-center">Activity</th>
                        <th class="text-center">User</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">User Agent</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1;  @endphp
                    @foreach($activityLog as $row)
                    <tr id="row{{$row->id}}">
                        <td class="align-middle text-center"> {{$counter++}} </td>
                        <td class="text-nowrap text-center align-middle">{{$row->activity}}</td>
                        <td class="text-nowrap text-center align-middle">{{Helper::getUser($row->user_id)->email}}</td>
                        <td class="text-center">{{$row->ip_address}}</td>
                        <td class="text-center"><small style="text-transform: capitalize">
                            @php
                                $user_agent = $row->user_agent;
                                if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
                                {
                                    $bname = 'Internet Explorer';
                                    $ub = "MSIE";
                                }
                                elseif(preg_match('/Firefox/i',$user_agent))
                                {
                                    $bname = 'Mozilla Firefox';
                                    $ub = "Firefox";
                                }
                                elseif(preg_match('/Chrome/i',$user_agent))
                                {
                                    $bname = 'Google Chrome';
                                    $ub = "Chrome";
                                }
                                elseif(preg_match('/Safari/i',$user_agent))
                                {
                                    $bname = 'Apple Safari';
                                    $ub = "Safari";
                                }
                                elseif(preg_match('/Opera/i',$user_agent))
                                {
                                    $bname = 'Opera';
                                    $ub = "Opera";
                                }
                                elseif(preg_match('/Netscape/i',$user_agent))
                                {
                                    $bname = 'Netscape';
                                    $ub = "Netscape";
                                }
                                echo $bname;

                                echo "<br>";

                                $bname = 'Unknown';
                                $platform = 'Unknown';

                                if (preg_match('/linux/i', $user_agent)) {
                                    $platform = 'linux';
                                }
                                elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
                                    $platform = 'mac';
                                }
                                elseif (preg_match('/windows|win32/i', $user_agent)) {
                                    $platform = 'windows';
                                }

                                echo $platform;
                            @endphp    
                        </small>
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
                        <td class="text-center">
                            <a  data-id="{{$row->id}}"  class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>







@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
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
                        url:'{{url("activity-logs")}}/'+id,
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
                        'has related data ',
                        'error'
                            )
                        }
                    });
                }
            })
        });

    </script>


@endsection
