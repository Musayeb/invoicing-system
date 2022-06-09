
@extends('layouts.auth')
@section('css')
    <!--- FONT-ICONS CSS -->
		<link href="{{asset('public/assets/css/icons.css')}}" rel="stylesheet"/>
@endsection

@section('content')    
<div class="page h-100">
    <div class="">
        <div class="container-login100">
            <div class="wrap-login100 p-6">
				<div class="col col-login mx-auto mb-5">
					<div class="text-center">
						<img src="{{asset('public/sarey.png')}}" class="header-brand-img" alt="">
					</div>
				</div>
                <form class="login100-form validate-form" method="POST" action="{{ route('password.confirm') }}">
                    <p class="text-center">This is a secure area of the application. Please confirm your password before continuing.</p>
					<x-jet-validation-errors class="mb-4 text-danger text-center" />
                    @csrf
                    <div class="wrap-input100 validate-input mt-5" data-validate = "Password is required" >
                        <input class="input100" type="password" id="password" name="password"  autocomplete="current-password" placeholder="Enter Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-lock" aria-hidden="true"></i>
                        </span>
                    </div>
            
                    <div class="container-login100-form-btn">
                        <button  type="submit" class="login100-form-btn btn-primary">
                            Confirm
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>

@endsection



