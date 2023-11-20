<div class="p-5 form-row">
    {{-- <h1 class="h4 text-gray-900 mb-4">Add Customer</h1> --}}
    <form class="user">
        <div class="form-group form-custom">
            <label class="text-gray-900">First Name</label>
            <input type="first_name" class="form-control form-control-user  @error('first_name') is-invalid @enderror" value="{{ isset($customer) ? $customer->first_name : old('first_name') }}" name ="first_name"
                id="Inputfirst_name" aria-describedby="first_nameHelp"
                placeholder="Enter First Name...">

                @error('first_name')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror

        </div>
        <div class="form-group form-custom">
            <label class="text-gray-900">Last Name</label>
            <input type="last_name" class="form-control form-control-user  @error('last_name') is-invalid @enderror" value="{{isset($customer) ? $customer->last_name : old('last_name')}}" name ="last_name"
                id="Inputlast_name" aria-describedby="last_nameHelp"
                placeholder="Enter Last Name...">

                @error('last_name')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Phone</label>
            <input type="phone" class="form-control form-control-user  @error('phone') is-invalid @enderror" value="{{isset($customer) ? $customer->phone : old('phone')}}" name ="phone"
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
            <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror" value="{{isset($customer) ? $customer->email : old('email')}}" name ="email"
                id="Inputemail" aria-describedby="emailHelp"
                placeholder="Enter Email Address...">

                @error('email')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom" style="width:100%">
            <label class="text-gray-900">Address</label>
            <input type="address" class="form-control form-control-user  @error('address') is-invalid @enderror" value="{{isset($customer) ? $customer->address : old('address')}}" name ="address"
                id="Inputaddress" aria-describedby="addressHelp"
                placeholder="Enter Address...">

                @error('address')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">City</label>
            <input type="city" class="form-control form-control-user" value="{{isset($customer) ? $customer->city : old('city')}}" name ="city"
                id="Inputlastname" aria-describedby="cityHelp"
                placeholder="Enter City...">

                @error('city')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">State</label>
            <input type="state" class="form-control form-control-user" value="{{isset($customer) ? $customer->state : old('state')}}" name ="state"
                id="Inputstate" aria-describedby="stateHelp"
                placeholder="Enter State...">

                @error('state')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Zip Code</label>
            <input type="zip_code" class="form-control form-control-user  @error('zip_code') is-invalid @enderror" value="{{isset($customer) ? $customer->zip_code : old('zip_code')}}" name ="zip_code"
                id="Inputzip_code" aria-describedby="zip_codeHelp"
                placeholder="Enter Zip Code...">

                @error('zip_code')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Country</label>
            <input type="country" class="form-control form-control-user" value="{{isset($customer) ? $customer->country : old('country')}}" name ="country"
                id="Inputcountry" aria-describedby="countryHelp"
                placeholder="Enter Country...">

                @error('country')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Identification Number(IC)</label>
            <input type="identification_number" class="form-control form-control-user" value="{{isset($customer) ? $customer->identification_number : old('identification_number')}}" name ="identification_number"
                id="Inputidentification_number" aria-describedby="identification_numberHelp"
                placeholder="Enter Date of Birth...">

                @error('identification_number')
                <div class="invalid-feedback">
                   {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group form-custom">
            <label class="text-gray-900">Gender</label>
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   
                    @if (isset($customer))
                        {{ $customer->gender }}
                    @elseif (old('gender'))
                        {{ old('gender') }}
                    @else
                        Select Gender
                    @endif
                
            </button>
                <input type="hidden" name="gender" value="{{ isset($customer) ? $customer->gender : old('gender') }}">
                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" name="gender" onclick="selectGender('Female')" value="Female">Female</a>
                    <a class="dropdown-item" name="gender" onclick="selectGender('Male')" value="Male">Male</a>
                </div>
                @error('gender')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary btn-user btn-sm form-group btn-block">
            @if (isset($customer))
                Save
            @else
                Add
            @endif
        </button>
        
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-user btn-sm form-group btn-block">Cancel</a>

        @if (session('message'))
            <div class="text-success">
                {{ session('message') }}
            </div>
        @endif
        
    </form>
</div>
<script>
    function selectGender(gender) {
        document.querySelector('button.dropdown-toggle').textContent = gender;
        document.querySelector('input[name="gender"]').value = gender;
    }
</script>