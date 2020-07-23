@include('front.partials.header')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
 
				
				<form class="login100-form validate-form" method="post" action="{{ route('login') }}">
                 @csrf
					<div class="login-logo"><a href=""> <img src="{{ asset('public/front/images/logo.jpeg') }}"> </a></div>
					<span class="login100-form-title">Tutor Login</span>
                     @if (session('status'))
                       <div class="alert alert-success">
                               {{ session('status') }}
                             </div>
                         @endif
                         
				         @if ($errors->any())
				        <div class="alert alert-danger">
				      
				           <h4>{{$errors->first()}}</h4>
				        
				        </div>
				        @endif

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror
					</div>					

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror
					</div>

					<div class="wrap-input100 validate-input colorwhite">
						<input type="checkbox" name=""> Remember Me
					</div>

					
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn"> SIGN IN </button>
					</div>

					<div class="text-center p-t-12">
						@if (Route::has('password.request'))
					         <a class="txt2" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

						<br /><br />

						<div class="text-center txt2"> Dont't have an account <a href="{{url('/tutor/register')}}">Sign Up</a> </div>
					</div>

				</form>
			</div>
		</div>
	</div>
	
@include('front.partials.footer')

<script type="text/javascript">

$("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 5000 ); 

});
</script>