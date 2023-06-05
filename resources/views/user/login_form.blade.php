<div class="p-5">
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
    </div>
    <form class="user">
        <div class="form-group">
            <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror" value="{{old('email')}}" name ="email"
                id="InputEmail" aria-describedby="emailHelp"
                placeholder="Enter Email Address...">

                @error('email')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" 
                id="InputPassword" placeholder="Password">
                
                @error('password')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="rememberCheck" name="rememberCheck" {{ old('rememberCheck') ? 'checked' : '' }}>
                <label class="custom-control-label" for="rememberCheck">Remember
                    Me</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user  btn-block">
            Login
        </button>
        @if (session('message'))
        <div class="text-success">
            {{ session('message') }}
        </div>
    @endif
        <hr>
        <a href="index.html" class="btn btn-google btn-user btn-block">
            <i class="fab fa-google fa-fw"></i> Login with Google
        </a>
        <a href="index.html" class="btn btn-facebook btn-user btn-block">
            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
        </a>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('user.forgotpassword')}}">Forgot Password?</a>
    </div>
    <div class="text-center">
        <a class="small" href="{{ route('user.register')}}">Create an Account!</a>
    </div>
</div>