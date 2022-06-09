@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <div class="card bg-danger img-card box-danger-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$total_project}}</h2>
                        <p class="text-white mb-0">Total Project </p>
                    </div>
                    <div class="ml-auto"> <i class="fa fa-send-o text-white fs-30 mr-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <div class="card bg-danger img-card box-danger-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$total_client}}</h2>
                        <p class="text-white mb-0">Total Client</p>
                    </div>
                    <div class="ml-auto"> <i class="fa fa-bar-chart text-white fs-30 mr-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <div class="card bg-danger img-card box-danger-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$total_invoice}}</h2>
                        <p class="text-white mb-0">Total Invoice</p>
                    </div>
                    <div class="ml-auto"> <i class="fa fa-dollar text-white fs-30 mr-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
  
</div>
@endsection
