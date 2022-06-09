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
            <table class="table mb-0  table-md table-bordered  text-nowrap w-100 dataTable no-footer" id="example">
                <thead class="thead-light">
                    <tr>
                        <th  class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">User Agent</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Last Activity</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1;  @endphp
                    @foreach($onlines as $row)

                    @php $email=Helper::getUser($row->user_id); @endphp    
                    @if (!empty($email->email))
                       
                    <tr >
                        <td class="align-middle text-center"> {{$counter++}} </td>
                        <td class="text-nowrap text-center align-middle"><small>{{Helper::getUser($row->user_id)->name}}</small></td>
                        <td class="text-nowrap text-center align-middle"><small>{{Helper::getUser($row->user_id)->email}}</small></td>
                        <th class="text-center"><small>{{$row->ip_address}}</small></th>
                        <th class="text-center"><small style="text-transform: capitalize">
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
                        
                        
                        </small></th>
                        <td class="align-middle text-center"> 
                            <span class="badge badge-pill badge-success">Login</span>
                        </td>
                        <td class="align-middle text-center" style="white-space: nowrap;width:100px"> 
                            @php
                                $dt = new DateTime("@$row->last_activity"); 
                                echo $dt->format('Y-m-d');
                            @endphp    
                            <br>
                            <small class="text-muted">
                                @php
                                    echo $dt->format('h:i:s a');
                                @endphp
                            </small>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>







@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Access Rights</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script>
        //  $('#example').DataTable();
    </script>
@endsection
