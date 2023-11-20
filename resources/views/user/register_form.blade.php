<div class="col-lg-7">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
        </div>
        <form class="user">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" name="first_name" value="{{old('first_name')}}" id="FirstName"
                        placeholder="First Name">
                        
                    @error('first_name')
                        <div class="invalid-feedback">
                           {{$message}}
                        </div>
                    @enderror

                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror" name="last_name" value="{{old('last_name')}}" id="LastName"
                        placeholder="Last Name">
   
                    @error('last_name')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                @enderror
                
                </div>
            </div>
            <div class="form-group">
                <input type="phone" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" id="InputPhone"
                    placeholder="Phone">

                           
                    @error('phone')
                        <div class="invalid-feedback">
                           {{$message}}
                        </div>
                    @enderror
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="InputEmail"
                    placeholder="Email Address">

                           
                    @error('email')
                        <div class="invalid-feedback">
                           {{$message}}
                        </div>
                    @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    name="password" id="InputPassword" placeholder="Password">

                           
                    @error('password')
                        <div class="invalid-feedback">
                           {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="RepeatPassword" placeholder="Repeat Password">

                               
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Register Account
            </button>
          
        <hr>
        <div class="text-center">
            <a class="small" href="{{route('user.forgotpassword')}}">Forgot Password?</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{route('user.login')}}">Already have an account? Login!</a>
        </div>
    </div>
</div>