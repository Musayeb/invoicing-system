
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
				<div class="col col-login mx-auto mb-4">
					<div class="text-center">
						<img src="http://sarey.co/wp-content/uploads/2020/09/Master-Logo-Artwork@20x.png" class="header-brand-img" alt="">
					</div>
				</div>
                <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
                    @csrf
					<p class="text-cente my-5">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                    <x-jet-validation-errors class="mb-4 text-danger text-center" />  
                    @if (session('status'))
                          <div class="mb-4 font-medium text-sm text-success ">
                              {{ session('status') }}
                          </div>
                    @endif
                    <div class="wrap-input100 validate-input mt-4" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" value="{{old('email')}}" required placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="icon icon-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
            
                    <div class="container-login100-form-btn">
                        <button href="#" type="submit" class="login100-form-btn btn-danger">
                            Email Password Reset Link
                        </button>
                    </div>
                 
                
                </form>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>

@endsection



