<div class="p-5">
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
    </div>
    <form class="user">
        <div class="form-group">
            <input type="oldpassword" class="form-control form-control-user  @error('oldpassword') is-invalid @enderror" value="{{old('oldpassword')}}" name ="oldpassword"
                id="InputOldPassword" aria-describedby="oldpasswordHelp"
                placeholder="Enter Old Password...">

                @error('oldpassword')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <div class="form-group">
            <input type="newpassword" class="form-control form-control-user @error('newpassword') is-invalid @enderror" name="newpassword" 
                id="InputNewPassword" placeholder="New Password">
                
                @error('newpassword')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <button type="submit" class="btn btn-primary btn-user  btn-block">
            Change Password
        </button>
        @if (session('message'))
        <div class="text-success">
            {{ session('message') }}
        </div>
    @endif
    </form>
</div>