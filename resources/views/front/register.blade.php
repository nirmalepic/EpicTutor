@include('front.partials.header')
	 
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
			
				<form class="login100-form validate-form" method="post" action="{{ route('tutor_register' )}}">
					@csrf
					<div class="login-logo"><a href=""> <img src="{{ asset('public/front/images/logo.png') }}"> </a></div>
					<span class="login100-form-title">Tutor Registration</span>
					@if(session()->has('success')) {
					<div class="alert alert-info">
					  {{ session()->get('success') }}
                   
                 </div>
                   @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        </div>
                        @endif

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="text" autocomplete="off" name="name" placeholder="Full Name" value="{{ old('name') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						<!--  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror -->
					</div>					

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="text" autocomplete="off" name="email" placeholder="Email" value="{{ old('email') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						 <!-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror -->
					</div>

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="number" name="contact" autocomplete="off" placeholder="Contact" value="{{ old('contact') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						 <!-- @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror -->
					</div>
                 
                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" autocomplete="off" name="address" placeholder="Address " value="{{ old('address') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>

                       <!--  @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                                @enderror -->
                    </div> 
                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" autocomplete="off" name="city" placeholder="City " value="{{ old('city') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>

                      <!--   @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                                @enderror -->
                    </div>  
                     <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" autocomplete="off" name="pincode" placeholder="Pincode " value="{{ old('pincode') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
<!-- 
                        @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                                @enderror -->
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="text" autocomplete="off" name="studentspecify" placeholder="Students Specify " value="{{ old('studentspecify') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>

                      <!--   @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                         @enderror -->
                    </div>
                    
                   
					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="password" autocomplete="off" name="password" placeholder="Password" title="Should have at least 1 lowercase AND 1 uppercase AND 1 number AND 1 symbol">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						<!--  @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror -->
					</div>

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="password" autocomplete="off" name="password_confirmation" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						 <!-- @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">* {{ $message }}</strong>
                                    </span>
                            @enderror -->
					</div>					
					
					<div class="container-login100-form-btn">
						<button type="submit"  class="login100-form-btn"> SIGN UP </button>
					</div>

					<div class="text-center p-t-12">
						<br /><br />

						<div class="text-center txt2"> Already have an account? <a href="{{url('/tutor/login')}}">Sign In</a> </div>
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
    }, 10000 ); 

});
</script>