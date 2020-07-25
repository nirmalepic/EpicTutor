@include('front.partials.header')
	
	<div class="limiter">
		<div class="container-login100">
				<header>
					<div class="container">
						<div class="row">
							<div class="col-md-6"><a href="javascript:void(0)"> <img src="{{ asset('public/front/images/logo.png') }}" class="The Go To"> </a></div>
							<div class="col-md-6">
								<div class="menusk">
									<ul>
										<li> <a href="{{route('tutor_login')}}"> Login </a> </li>
										<li> <a href="{{route('tutor_register')}}"> Register </a> </li>
									</ul>
								</div>
							</div>							
						</div>
					</div>
				</header>
		</div>
	</div>
	
	
@include('front.partials.footer')
	