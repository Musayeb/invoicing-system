
@extends('layouts.auth')
@section('content')    



<div class="page h-100">
    <div class="">
       
        <div class="container-login100">
            <div class="wrap-login100 p-6">
                <div class="col col-login mx-auto mb-5">
                    <div class="text-center">
						<img src="http://sarey.co/wp-content/uploads/2020/09/Master-Logo-Artwork@20x.png" class="header-brand-img" alt="">
					</div>
				</div>
                <br>
				<x-jet-validation-errors class="mb-4 text-danger text-center" />
                <form class="login100-form validate-form" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                    <div class="wrap-input100 validate-input mb-4" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" value="{{old('email')}}" required placeholder="Enter Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input mb-4" data-validate = "Password is required">
                        <input class="input100"  placeholder="Enter Password"  id="password"  type="password" name="password" required autocomplete="new-password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input mb-4" data-validate = "Password is required">
                        <input class="input100"  type="password" name="password_confirmation"  autocomplete="new-password" placeholder="Enter Confirm Password" id="password_confirmation">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-lock" aria-hidden="true"></i>
                        </span>
                    </div>
            
            
                    <div class="container-login100-form-btn">
                        <button href="#" type="submit" class="login100-form-btn btn-danger">
                            Reset Password
                        </button>
                    </div>
                 
                
                </form>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>

@endsection

