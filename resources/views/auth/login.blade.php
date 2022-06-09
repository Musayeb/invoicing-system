
@extends('layouts.auth')
@section('css')
    <!--- FONT-ICONS CSS -->
		<link href="{{asset('public/assets/css/icons.css')}}" rel="stylesheet"/>
@endsection

@section('content')    


<div class="page h-100">
    <div>
       
        <div class="container-login100">
            <div class="wrap-login100 p-6">

				 <div class="col col-login mx-auto mb-4">
					<div class="text-center">
						<img src="http://sarey.co/wp-content/uploads/2020/09/Master-Logo-Artwork@20x.png" class="header-brand-img" alt="">
					</div>
				</div>
                <form class="login100-form validate-form" method="POST"  action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-title">
                        Login
                    </span>
                    <x-jet-validation-errors class="mb-4 text-danger text-center" />  
                    @if (session('status'))
                          <div class="mb-4 font-medium text-sm text-success text-center">
                              {{ session('status') }}
                          </div>
					@endif

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" value="{{old('email')}}" required placeholder="Enter Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input mt-5" data-validate = "Password is required">
                        <input class="input100" type="password" name="password"   autocomplete="current-password" placeholder="Enter Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="check-box mt-5">
                        <input type="checkbox" name="remember" id="type-1"> 
                        <label for="type-1">Remember me</label>
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 float-right" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                       @endif
                    </div>
            
            
                    <div class="container-login100-form-btn">
                        <button href="#" type="submit" class="login100-form-btn btn-danger">
                            Login
                        </button>
                    </div>
                 
                
                </form>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>

@endsection

