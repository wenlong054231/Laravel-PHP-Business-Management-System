
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   

<div class="p-5 form-row">
    {{-- <h1 class="h4 text-gray-900 mb-4">Add Customer</h1> --}}
    <form class="user">
        <div class="form-group form-custom">
            <label class="text-gray-900">Name</label>
            <input type="name" class="form-control form-control-user  @error('name') is-invalid @enderror" value="{{ isset($users) ? $users->name : old('name') }}" name ="name"
                id="Inputname" aria-describedby="nameHelp"
                placeholder="Enter Name...">

                @error('name')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        
        <div class="form-group form-custom">
            <label class="text-gray-900">Phone</label>
            <input type="phone" class="form-control form-control-user  @error('phone') is-invalid @enderror" value="{{ isset($users) ? $users->phone : old('phone') }}" name ="phone"
                id="Inputphone" aria-describedby="phoneHelp"
                placeholder="Enter Phone...">

                @error('phone')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Email</label>
            <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror" value="{{ isset($users) ? $users->email : old('email') }}" name ="email"
                id="Inputemail" aria-describedby="emailHelp"
                placeholder="Enter Email...">

                @error('email')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Role</label>
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   
                    @if (isset($users) && $users->role !== '')
                        {{ $users->role }}
                    @elseif (old('role'))
                        {{ old('role') }}
                    @else
                        Select Role
                    @endif
                
            </button>
                <input type="hidden" name="role" value="{{ isset($users) ? $users->role : old('role') }}">
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" name="role" onclick="selectRole('admin')" value="admin">Admin</a>
                    <a class="dropdown-item" name="role" onclick="selectRole('staff')" value="staff">Staff</a>                    
                </div>
                @error('expenses_type')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>       
        
        <button type="submit" class="btn btn-primary btn-user btn-sm form-group btn-block">            
            Save        
        </button>
        
        <a href="{{ route('admin.users',['tableName' => 'users']) }}" class="btn btn-primary btn-user btn-sm form-group btn-block">Cancel</a>

        @if (session('message'))
            <div class="text-success">
                {{ session('message') }}
            </div>
        @endif
        
    </form>
</div>
<script type="text/javascript">
    function selectRole(role) {
        document.querySelector('button.dropdown-toggle').textContent = role;
        document.querySelector('input[name="role"]').value = role;
    }
        

    $(document).ready(function() {
    // Get the initial selected insurance type
    var initialRole = document.querySelector('button.dropdown-toggle').textContent;
   
    // Call the selectRole function with the initial insurance type
    selectRole(initialRole);
});
</script>